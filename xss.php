<?php
    session_start();

    echo "<form name='data' method='post'>";
    echo "<input type='text' name='text'>";
    echo "<input type='submit' value='submit' name='submit'>";
    echo "</form>";

    $banlist = ['script', 'onerror',];

    if( isset( $_SESSION["id"] ) ) {

        if( $_SESSION["id"] === 'admin' ) {
            echo "<script>location.replace('591797f6e3fe230183ad5be1783900c71d5036c7b72d6326a207e1f324a31b603.html');</script>";
        };

        if( $_SESSION["id"] !== 'piolink' ) {
            echo "<script>";
            echo "setTimeout( function() { alert('세션이 유효하지 않습니다.'); }, 0 );";
            echo "</script>";
            ob_flush();

            echo "<script>location.replace('index.php');</script>";
            exit;
        };

        if( isset( $_POST['text'] ) ) {
            $text = $_POST['text'];
            $allow = true;

            foreach ( $banlist as $banword ) {
                #if( strpos( $text, $banword ) !== false ) {
                if( strpos( strtolower( $text ), $banword ) !== false ) {
                    $allow = false;
                    $word = $banword;
                    break;
                };
            };

            if( $allow ) {
                echo $text;
            } else {
                echo "not allowed : ".$word;
            };


        } else {
            echo "input TEXT";
        };
    } else {
        echo "<script>";
        echo "setTimeout( function() { alert('로그인 후 시도해주세요.'); }, 0 );";
        echo "</script>";
        ob_flush();

        echo "<script>location.replace('index.php');</script>";
        exit;
    };

?>
