<?php
    $conn = mysqli_connect(
        'localhost',
        'xss',
        'xss_password',
        'test_login'
    );

    session_start();

    echo "<form name='data' method='post'>";
    echo "<input type='text' name='text'>";
    echo "<input type='submit' value='submit' name='submit'>";
    echo "</form>";

    $sql = "SELECT test_id FROM test_table;";
    $result = $conn -> query( $sql );
    $rows = array();
    $allow = false;

    while( $row = mysqli_fetch_array( $result ) ) {
        $rows[] = $row;
    };

    foreach( $rows as $key => $row ) {
        if( $row[0] === $_SESSION["id"] ) {
            $allow = true;
        };
    };


    $banlist = ['script', 'onerror', 'onclick'];

    if( isset( $_SESSION["id"] ) ) {

        if( $_SESSION["id"] === 'admin' ) {
            echo "<script>location.replace('10c4bc9202e6fd7ccd5f9b0958aad0f4b279f6ce44e60ea842b9171e6e6d3865.html');</script>";
        } else if( $allow === false ) {
            echo "<script>";
            echo "setTimeout( function() { alert('세션이 유효하지 않습니다.'); }, 0 );";
            echo "</script>";
            ob_flush();

            echo "<script>location.replace('index.php');</script>";
            exit;
        } else {

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
