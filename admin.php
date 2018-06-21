<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 19:03
 */
if (isset($_SESSION["LoggedInUser"])) {
    $LoggedInUser = $_SESSION["LoggedInUser"];
    if ($LoggedInUser != null) {
        $Rights = \DAL\DBRoleConnection::GetUserRights($LoggedInUser);

        if ($Rights != null && is_object($Rights[0])) {
            //2 is the 3 row in de array which stands for the right admin page

            if ($Rights[2]->ID == 3) {
                if ($Rights[2]->Description == "AdminPage") {
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".AdminPageNavItem").on("click",function () {
                                $(".AdminPageContent").removeClass("active");
                                var ContentID ="Content"+$(this).attr('id');
                                $("#"+ContentID).addClass("active");
                            });
                        });
                    </script>
                    <div class="Page">
                        <div class="PageTitle">Beheer pagina</div>
                        <div class="PageContent">
                            <div class="row">
                                <div class="col-sm-3" style="border-right: 1px solid white;">
                                    <?php
                                    $PageItems = \DAL\DBPageConnection::GetAdminPageItems();
                                    if(isset($PageItems)) {
                                        foreach ($PageItems as $item) {
                                            echo "<input type='button' class='AdminPageNavItem' id='AdItem".$item->ID."' value='".$item->Item."'>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-9">
                                    <?php
                                    foreach ($PageItems as $item) {
                                        echo "<div id='ContentAdItem".$item->ID."' class='AdminPageContent'>".$item->Content."</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if(isset($_POST["NewPageTitle"])&&isset($_POST["NewPageCode"])){
                                echo "<div class='Message' style='width: fit-content'><div class='MessageTitle'></div>Opgeslagen<hr/><div class='MessageText'>De nieuwe pagina '".$_POST["NewPageTitle"]."'is opgeslagen.</div></div>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php



                } else {
                    // header("location: 404");
                    echo "adminpage";
                }
            } else {
                //header("location: 404");
                echo "id";
            }
        } else {
            echo "Geen rechten voor deze pagina";
        }
    }
} else {
    header("location: login");
}
?>

