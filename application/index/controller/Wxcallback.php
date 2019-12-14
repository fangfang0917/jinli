<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 11:22
 */

namespace app\index\controller;


use think\Cache;
use think\Session;
use think\Config;
use think\response\Redirect;
use think\Loader;
use think\Db;
use think\Exception;
use think\View;
use think\Request;

class Wxcallback
{
    protected $sys;

    public function index($str = false)
    {
        $sys = db('userop')->where(array('id' => 0))->find();
        $this->sys = json_decode($sys['userop'], true);
        if ($str == false) {
            $xmlData = file_get_contents("php://input");
        } else {
            $xmlData = $str;
        }
        $getData = $this->xmlstr_to_array($xmlData);
        $buy_status = $getData['result_code'];
        $buy_type = explode('_', $getData['out_trade_no']);
        if (strtoupper($buy_status) == 'SUCCESS') {
            file_put_contents(ROOT_PATH . 'public/text.log', date('YmdHis') . '=======' . $buy_type[0] . '=============' . "\n", FILE_APPEND);
            file_put_contents(ROOT_PATH . 'public/text.log', date('YmdHis') . '=======' . strtoupper($buy_status) . '=============' . "\n", FILE_APPEND);
            file_put_contents(ROOT_PATH . 'public/text.log', date('YmdHis') . '=======' . $buy_type[1] . '=============' . "\n", FILE_APPEND);
            file_put_contents(ROOT_PATH . 'public/text.log', date('YmdHis') . '==========参数结束==========' . "\n", FILE_APPEND);
            if ($buy_type[0] == 'levelup') {
                $this->levelup($buy_type[2], $buy_type[1]);
            } else if ($buy_type[0] == 'buyvip') {
                $this->buyvip($buy_type[1]);
            } else if ($buy_type[0] == 'buyCourse') {
                $this->buycourse($buy_type[3], $buy_type[1]);
            }
        }
    }

    //代理推荐会员收益
    private function buyvip($order_id)
    {
        $order = db('order')->where(array('id' => $order_id))->find();
        if ($order['pay_type'] != 1) {
            db('order')->where(array('id' => $order_id))->update(array('pay_type' => 1));
            $user_id = $order['user_id'];
            $user = Db('user')->where(array('id' => $user_id))->find();
            if ($user['level'] != 1) {
                db('user')->where(array('id' => $user_id))->update(array('level' => 1, 'buy_vip_time' => time(), 'share_level' => 2));
                if ($user['pid'] != 0) {
                    $prent = db('user')->where(array('id' => $user['pid']))->field(array('pid', 'level', 'id'))->find();
                    db('user')->where(array('id' => $user['pid']))->setInc('share_num', 1);
                    if ($prent['level'] == 0) {
                        $tmoney = 0;
                    } else if ($prent['level'] == 1) {
                        $tmoney = $this->sys['vip_money_op1'];
                    } else if ($prent['level'] == 2) {
                        $tmoney = $this->sys['vip_team_money_op1'];
                    } else if ($prent['level'] == 3) {
                        $tmoney = $this->sys['vip_team1_money_op1'];
                    } else if ($prent['level'] == 4) {
                        $tmoney = $this->sys['vip_team2_money_op1'];
                    } else {
                        $tmoney = $this->sys['vip_team3_money_op1'];
                    }
                    if ($tmoney > 0) {
                        db('user')->where(array('id' => $prent['id']))->setInc('amount', $tmoney);
                        $ppdata = array(
                            'user_id' => $prent['id'],
                            'son_id' => $user_id,
                            'amount' => $tmoney,
                            'type' => 1,
                            'add_time' => time(),
                            'remarks' => '直接推荐VIP奖励'
                        );
                        DB('user_record')->insert($ppdata);
                    }
                    if ($prent['pid'] != 0) {
                        $prentt = db('user')->where(array('id' => $prent['pid']))->field(array('level', 'id'))->find();
                        db('user')->where(array('id' => $prent['pid']))->setInc('share_num', 1);
                        if ($prentt['level'] == 0) {
                            $ttmoney = 0;
                        } else if ($prentt['level'] == 1) {
                            $ttmoney = $this->sys['vip_money_op2'];
                        } else if ($prentt['level'] == 2) {
                            $ttmoney = $this->sys['vip_team_money_op2'];
                        } else if ($prentt['level'] == 3) {
                            $ttmoney = $this->sys['vip_team1_money_op2'];
                        } else if ($prentt['level'] == 4) {
                            $ttmoney = $this->sys['vip_team2_money_op2'];
                        } else {
                            $ttmoney = $this->sys['vip_team3_money_op2'];
                        }
                        db('user')->where(array('id' => $prentt['id']))->setInc('amount', $ttmoney);
                        $ppdata = array(
                            'user_id' => $prentt['id'],
                            'son_id' => $user_id,
                            'amount' => $ttmoney,
                            'type' => 2,
                            'add_time' => time(),
                            'remarks' => '间接推荐VIP奖励'
                        );
                        DB('user_record')->insert($ppdata);
                    }
                }
                $this->getAgent($user_id, $this->sys['vip_money']);

            }
        }
        return "<xml>
                                     <return_code><![CDATA[SUCCESS]]></return_code>
                                     <return_msg><![CDATA[OK]]></return_msg>
                                </xml>";

    }

    private function levelup($level, $order_id)
    {
        $order = Db('order')->where(array('id' => $order_id))->find();
        if ($order['pay_type'] != 1) {
            Db('order')->where(array('id' => $order_id))->update(array('pay_type' => 1));
            $user_id = $order['user_id'];
            $user = Db('user')->where(array('id' => $user_id))->field(array('pid', 'level', 'sharetype'))->find();
            if ($user['level'] != $level) {
                if ($user['level'] == 1) {
                    Db('user')->where(array('id' => $user_id))->update(array('level' => $level, 'level_type' => 2, 'buy_agent_time' => time()));
                } else {
                    Db('user')->where(array('id' => $user_id))->update(array('level' => $level, 'level_type' => 2));
                }
                if ($user['sharetype'] != 0) {
                    if ($user['pid'] != 0) {
                        $prent = Db('user')->where(array('id' => $user['pid']))->field(array('level'))->find();
                        if ($prent['level'] > 1) {
                            if ($level == 2) {
                                $ymoney = $this->sys['vip_tui_c'];
                                $str = '成功推荐白银会员奖励';
                            } else if ($level == 3) {
                                $ymoney = $this->sys['vip_tui_z'];
                                $str = '成功推荐黄金会员奖励';
                            } else if ($level == 4) {
                                $ymoney = $this->sys['vip_tui_g'];
                                $str = '成功推荐铂金会员奖励';
                            } else if ($level == 5) {
                                $ymoney = 20000;
                                $str = '成功推荐钻石会员奖励';
                            }
                            db('user')->where(array('id' => $user['pid']))->setInc('amount', $ymoney);
                            $ppdata = array(
                                'user_id' => $user['pid'],
                                'son_id' => $user_id,
                                'amount' => $ymoney,
                                'type' => 4,
                                'add_time' => time(),
                                'remarks' => $str
                            );
                            DB('user_record')->insert($ppdata);
                            return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");

                        }
                    }
                }
            }
        }
    }

    private function buycourse($money, $order_id)
    {

        $order = Db('order')->where(array('id' => $order_id))->find();
        if ($order['pay_type'] != 1) {
            $user_id = $order['user_id'];
            db('order')->where(array('id' => $order_id))->update(array('pay_type' => 1));
            $user = Db('user')->where(array('id' => $user_id))->field(array('pid', 'level'))->find();
            $order = db('order')->where(array('id' => $order_id))->find();
            $course = DB('course')->where(array('id' => $order['course_id']))->find();
            $course_info = db('course_info')->where(array('course_id' => $order['course_id']))->select();
            if($course['course_isvip'] > 0){
                if($user['level'] < $course['course_isvip']){
                    db('user')->where(array('id'=>$user_id))->data(array('level'=>$course['course_isvip']))->update();
                }
            }
            foreach ($course_info as $k => $v) {
                $arr = array('course_id' => $order['course_id'], 'course_info_id' => $v['id'], 'user_id' => $user_id);
                db('user_course')->insert($arr);
            }
            if ($user['pid'] != 0) {
                $prent = db('user')->where(array('id' => $user['pid']))->field(array('pid', 'level'))->find();
                if ($prent['level'] > 0) {

                    if ($course['course_money_op'] != 0) {
                        $m = $course['course_money_op'];

                    } else {
                        $m = $money * $this->sys['op_danke_z'] / 100;

                    }
                    db('user')->where(array('id' => $user['pid']))->setInc('amount', $m);
                    $pppdata = array(
                        'user_id' => $user['pid'],
                        'son_id' => $user_id,
                        'amount' => $m,
                        'type' => 1,
                        'add_time' => time(),
                        'remarks' => '购买'.$course['course_title'].'直接奖励'
                    );
                    DB('user_record')->insert($pppdata);
                    if ($prent['pid'] != 0) {
                        if ($course['course_money_op1'] != 0) {
                            $mm = $course['course_money_op1'];
                        } else {
                            $mm = $money * $this->sys['op_danke_j'] / 100;
                        }
                        db('user')->where(array('id' => $prent['pid']))->setInc('amount', $mm);
                        $ppppdata = array(
                            'user_id' => $prent['pid'],
                            'son_id' => $user_id,
                            'amount' => $mm,
                            'type' => 2,
                            'add_time' => time(),
                            'remarks' => '购买'.$course['course_title'].'间接奖励'
                        );
                        DB('user_record')->insert($ppppdata);
                    }
                }
            }
            $this->getAgent($order['user_id'], $money);
        } else {
            return "<xml>
                         <return_code><![CDATA[SUCCESS]]></return_code>
                         <return_msg><![CDATA[OK]]></return_msg>
                    </xml>";
        }

    }

    private function xmlstr_to_array($xmlstr)
    {
        $doc = new \DOMDocument();
        $doc->loadXML($xmlstr);
        return $this->domnode_to_array($doc->documentElement);
    }

    private function domnode_to_array($node)
    {
        $output = array();
        switch ($node->nodeType) {
            case XML_CDATA_SECTION_NODE:
            case XML_TEXT_NODE:
                $output = trim($node->textContent);
                break;
            case XML_ELEMENT_NODE:
                for ($i = 0, $m = $node->childNodes->length; $i < $m; $i++) {
                    $child = $node->childNodes->item($i);
                    $v = $this->domnode_to_array($child);
                    if (isset($child->tagName)) {
                        $t = $child->tagName;
                        if (!isset($output[$t])) {
                            $output[$t] = array();
                        }
                        $output[$t][] = $v;
                    } elseif ($v) {
                        $output = (string)$v;
                    }
                }
                if (is_array($output)) {
                    if ($node->attributes->length) {
                        $a = array();
                        foreach ($node->attributes as $attrName => $attrNode) {
                            $a[$attrName] = (string)$attrNode->value;
                        }
                        $output['@attributes'] = $a;
                    }
                    foreach ($output as $t => $v) {
                        if (is_array($v) && count($v) == 1 && $t != '@attributes') {
                            $output[$t] = $v[0];
                        }
                    }
                }
                break;
        }
        return $output;
    }


    private function getAgent($id, $money)
    {
        $user = Db('user')->where(array('id' => $id))->find();
        if ($user['pid'] != 0) {
            $puser = Db('user')->where(array('id' => $user['pid']))->field(array('pid', 'level','id'))->find();
            if ($puser['pid'] != 0) {
                $ppuser = Db('user')->where(array('id' => $puser['pid']))->field(array('pid', 'level','id'))->find();
                if ($puser['level'] > 1 && $ppuser['level'] > 1) {
                    if ($ppuser['level'] == 2) {
                        $money = $money * $this->sys['vip_team_fuwu'] / 100;

                    } elseif ($ppuser['level'] == 3) {
                        $money = $money * $this->sys['vip_team1_fuwu'] / 100;

                    } elseif ($ppuser['level'] == 4) {
                        $money = $money * $this->sys['vip_team2_fuwu'] / 100;

                    } elseif ($ppuser['level'] == 5) {
                        $money = $money * $this->sys['vip_team3_fuwu'] / 100;
                    }
                    Db('user')->where(array('id' => $ppuser['id']))->setInc('amount', $money);
                    if ($money != 0) {
                        $data = array(
                            'user_id' => $ppuser['id'],
                            'son_id' => $id,
                            'amount' => $money,
                            'remarks' => '代理服务奖',
                            'type' => 5,
                            'add_time' => time(),
                        );

                        db('user_record')->insert($data);
                    }

                }
                if ($ppuser['pid'] != 0) {
                    $pppuser = Db('user')->where(array('id' => $ppuser['pid']))->field(array('pid', 'level','id'))->find();
                    if ($ppuser['level'] > 1 && $pppuser['level'] > 1) {
                        if ($pppuser['level'] == 2) {
                            $money = $money * $this->sys['vip_team_fuwu'] / 100;

                        } elseif ($pppuser['level'] == 3) {
                            $money = $money * $this->sys['vip_team1_fuwu'] / 100;

                        } elseif ($pppuser['level'] == 4) {
                            $money = $money * $this->sys['vip_team2_fuwu'] / 100;

                        } elseif ($pppuser['level'] == 5) {
                            $money = $money * $this->sys['vip_team3_fuwu'] / 100;
                        }
                        Db('user')->where(array('id' => $pppuser['id']))->setInc('amount', $money);
                        if ($money != 0) {
                            $data = array(
                                'user_id' => $pppuser['id'],
                                'son_id' => $id,
                                'amount' => $money,
                                'remarks' => '代理服务奖',
                                'type' => 5,
                                'add_time' => time(),
                            );

                            db('user_record')->insert($data);
                        }

                    }

                }

            }

        }
    }


}