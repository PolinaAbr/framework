<?php
if (!defined('PF_CORE_INCLUDE') || PF_CORE_INCLUDE !== true) die();
$path = Polinaframework\Core\Application::getInstance()->getTemplatePath(false);
$app = \Polinaframework\Core\Application::getInstance();
$app->setProperty("title", "База знаний");
?>
</div>
</div>
</div>
</div>

        <div class="footer">
            <div class="container-fluid">
                <div class="footer__wrap">
                    <span>© Manao, 2018</span>
                    <span>Design by "KBK Group"</span>
                </div>
            </div>
        </div>
    </div>
    <script src=<? echo $path . "/libs/highlightjs/highlight.pack.js"?>></script>
    <script type='text/javascript'>hljs.initHighlightingOnLoad();</script>
</body>

</html>