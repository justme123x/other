<?php

/**
 * LuckRate
 * 抽奖概率
 */
class LuckRate
{
    const MAX_RATE = 1000000;
    private $_propb = array();
    private $_alias = array();

    function init(array $data)
    {
        $nums = count($data);
        $small = $large = array();
        for ($i = 0; $i < $nums; ++$i) {
            $data[$i] = $data[$i] * $nums;

            if ($data[$i] < 1) {
                $small[] = $i;
            } else {
                $large[] = $i;
            }
        }

        while (!empty($small) && !empty($large)) {
            $n_index = array_shift($small);
            $a_index = array_shift($large);

            $this->_propb[$n_index] = $data[$n_index];
            $this->_alias[$n_index] = $a_index;
            $data[$a_index] = ($data[$a_index] + $data[$n_index]) - 1;

            if ($data[$a_index] < 1) {
                $small[] = $a_index;
            } else {
                $large[] = $a_index;
            }
        }

        while (!empty($large)) {
            $n_index = array_shift($large);
            $this->_propb[$n_index] = 1;
        }

        while (!empty($small)) {
            $n_index = array_shift($small);
            $this->_propb[$n_index] = 1;
        }

        return $this;
    }

    /**
     * @desc 获取奖励
     * @param array $prob
     * @param array $alias
     * @return int
     */
    function generation()
    {
        $prob = $this->_propb;
        $alias = $this->_alias;
        $nums = count($prob) - 1;

        $coin_toss = rand(1, self::MAX_RATE) / self::MAX_RATE;

        $col = rand(0, $nums);
        $b_head = ($coin_toss < $prob[$col]) ? TRUE : FALSE;

        $result = $b_head ? $col : $alias[$col];
        if (is_null($result))
            return generation($prob, $alias);
        return $result;
    }
}

$prize_arr = array(
    array('id' => 1, 'title' => '特等奖', 'v' => 1),
    array('id' => 2, 'title' => '一等奖', 'v' => 5),
    array('id' => 3, 'title' => '二等奖', 'v' => 10),
    array('id' => 4, 'title' => '三等奖', 'v' => 15),
    array('id' => 6, 'title' => '幸运奖', 'v' => 20),
    array('id' => 7, 'title' => '未中奖', 'v' => 50),
);
$data = array_column($prize_arr, 'v');
$data = array_map(function ($item) {
    return $item / 100;
}, $data);

$cc = array();
$obj = new LuckRate();
for ($i = 0; $i < 100000; $i++) {
    $result = $obj->init($data)->generation();
    if (isset($prize_arr[$result])) {
        $cc[$result]['num'] += 1;
        $cc[$result]['project'] = $prize_arr[$result];
    } else {
        var_dump($result);
        exit;
    }

}
var_dump($cc);