<?php //フロントコントローラ

require_once __DIR__ . '/controllers/PracticeController.php';

// リクエストメソッドの種類
$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod != 'GET' && $requestMethod != 'POST') {
    // GETでもPOSTでもない場合に行うエラー処理
    clientError("本システムではGET/POST以外対応していません。");
}

// リクエストがGETならtrue、POSTならfalse、それ以外ならnull
$isExistsPathInGet = isset($_GET['path']);
$isExistsPathInPost = isset($_POST['path']);

$path = !$isExistsPathInGet &&  !$isExistsPathInPost ? null :
        ($isExistsPathInGet ?  $_GET['path'] : $_POST['path']);

$practiceController = new PracticeController();

if (is_null($path)) {
    clientError("pathクエリパラメータが指定されていません。"); //http://localhost/my-site/
} else if($path == "form") { 
    $practiceController->form(); //http://localhost/my-site/?path=form
} else if($path == "result") {
    $practiceController->result(); //http://localhost/my-site/?path=form&sendText=xxx
}

// クライアントエラー用のアクション
// 設計上ありえないアクセスがあった際に実行されるコントローラーアクション
function clientError($errorMsg) {
    require_once __DIR__ . '/views/error.phtml';
}