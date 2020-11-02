<?php 

/* 40 じゃんけんを作成しよう！
下記の要件を満たす「じゃんけんプログラム」を開発してください。
要件定義
・使用可能な手はグー、チョキ、パー
・勝ち負けは、通常のじゃんけん
・PHPファイルの実行はコマンドラインから。
ご自身が自由に設計して、プログラムを書いてみましょう！ */

const HAND_TYPE = array(0, 1, 2);
const HAND_NAME = array(0 => "グー", 1 => "チョキ", 2 => "パー");
const RESULT = array('あいこ', '負け', '勝ち');
const ANSWER = array('いいえ', 'はい');

// バリデーションチェック
function checkValue($value){
    if($value == null || !(in_array($value, HAND_TYPE)) || !(is_numeric($value))){
        return false;
    }
    return true;
}

// 手の入力
function selectHand(){
    echo '希望の手の数値を入力してください。 ' . "\n" . '{0: グー、 1: チョキ、　2: パー}' . PHP_EOL;
    $hand = trim(fgets(STDIN));
    $check = checkValue($hand);
    if(!$check){
        return selectHand();
    }
    return $hand;
}

// 相手のランダムに入力
function getComHand(){
    echo '相手の手を入力します。' . PHP_EOL;
    return array_rand(HAND_TYPE, 1);
}

// 勝ち負け判定
function judge($myhand, $com_hand){
    echo "あなたの手は" . HAND_NAME[$myhand] . "です" . PHP_EOL;
    echo "相手の手は" . HAND_NAME[$com_hand] . "です" . PHP_EOL;
    return ($myhand - $com_hand + 3) % 3;
}

function show($result){
    echo '結果は、' . RESULT[$result] . "です。" . PHP_EOL;
};

function check_answer($answer){
    if(!($answer)){
        return false;
    }
    return true;
}

function retry(){
    echo 'じゃんけんを続けますか. 「はい」か「いいえ」でお答えください。' . PHP_EOL;
    $answer = trim(fgets(STDIN));
    $check_answer = check_answer($answer);
    if(!$check_answer){
        return retry();
    }
    $answer_key = array_keys(ANSWER, $answer);
    $answer = $answer_key[0];
    echo $answer;
    if($answer== 1){
        return true;
    }
    return false;

}

function rockPaperScissors() {
    $myhand = selectHand();
    $com_hand = getComHand();
    //判定
    $result = judge($myhand, $com_hand);
    //勝敗表示
    show($result);
    //あいこ　なら、再帰関数
    if($result == 0){
        return rockPaperScissors();
    }
    //ゲームを続けるか確認
    $check_retry = retry();
    if($check_retry){
        return rockPaperScissors();
    }
}

rockPaperScissors();
?>