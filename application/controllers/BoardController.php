<?php

namespace application\controllers;

use application\models\BoardModel;

class BoardController extends Controller
{
    public function list()
    {
        $model = new BoardModel();

        // $this->list = $model->selBoardList();
        $this->addAttribute("title", "리스트");
        $this->addAttribute("list", $model->selBoardList());
        $this->addAttribute("js", ["board/list"]);

        return "board/list.php"; // view 파일명
    }
    public function detail()
    {
        $model = new BoardModel();

        // print "i_board : {i_board}<br>";
        $param = ["i_board" => $_GET["i_board"]];

        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute(_TITLE, "디테일");
        $this->addAttribute("js", ["board/detail"]);

        return "board/detail.php";

        // 글번호, 제목, 내용, 글쓴이 이름, 작성일
    }

    public function del()
    {
        $model = new BoardModel();

        $param = ["i_board" => $_GET["i_board"]];
        $model->delBoard($param);

        return "redirect:/board/list";
    }

    public function mod()
    {
        $model = new BoardModel();

        $param = ["i_board" => $_GET["i_board"]];

        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute(_TITLE, "수정");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

        return "template/t1.php";
    }

    public function modProc()
    {
        $model = new BoardModel();

        $i_board = $_POST["i_board"];
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];

        $param = [
            "i_board" => $i_board,
            "title" => $title,
            "ctnt" => $ctnt,
        ];

        $model->updBoard($param);

        return "redirect: detail?i_board=${i_board}";
    }
}
