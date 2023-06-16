<?php
    $conn = mysqli_connect(
                'localhost',
                'xss',
                'xss_password',
                'test_login'
    );

    echo "<form name='login' method='post'>";
    echo "<input type='text' name='id' placeholder='ID'>";
    echo "<input type='password' name='password' placeholder='PASSWORD'>";
    echo "<input type='submit' name='submit' value='login'></form>";

    if( isset( $_POST['submit'] ) ) {
        $id = $_POST['id'];
        $pw = $_POST['password'];

        $sqlq = "SELECT test_id FROM test_table WHERE test_id = '$id' AND test_pw = '$pw'";
        $result = $conn -> query( $sqlq );

        if( $result -> num_rows > 0 ) {
            session_start();
            $_SESSION["id"] = $id;
            header( "location:xss.php" );
        } else {
            echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');</script>";
            echo "<!-- SELECT test_id FROM test_table WHERE test_id = 'ID' AND test_pw = 'PASSWORD'; -->";
        };
    };
?>
