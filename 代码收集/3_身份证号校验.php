  <?php 

   /**
     * 身份证格式检查
     * @param identity  身份证号码
     * @return boolean
     */
 function identityCheck($identity) {
        if (empty($identity)) {
            return false;
        }
        // 加权因子
        $positionScore = ['7', '9', '10', '5', '8', '4', '2', '1', '6', '3', '7', '9', '10', '5', '8', '4', '2'];
        $identityLength = strlen($identity);
        // 该方法对旧版本身份证不适用，遂不检测，默认成功，交由芝麻信用判断
        if ($identityLength == 15) {
            return true;
        }
        $totalScore = 0;
        for ($i = 0; $i < $identityLength - 1; $i++) {
            if (! isset($positionScore[$i])) {
                return false;
                
            }
            $totalScore += intval($identity[$i]) * $positionScore[$i];
        }
        $checkIndex = $totalScore % 11;
        // 校验码表
        $checkScore = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        if (! isset($checkScore[$checkIndex])){
            return false;
        }
        if ($checkScore[$checkIndex] == $identity[$identityLength - 1]) {
            return true;
        }
        return false;

}