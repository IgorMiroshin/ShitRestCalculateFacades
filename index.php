<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/templates/diez__baltlaminat_template/components/bitrix/catalog/services/include/facades/class/Facades.php";
?>

<?php
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$method = $request->getQuery("method");
if (!empty($method)) {
    echo json_encode(Facades::GetDataObject($method));
}
?>
<noscript><strong>We're sorry but vue--table doesn't work properly without JavaScript enabled. Please enable it to
        continue.</strong></noscript>
<div id="app"></div>

<script src="/local/templates/diez__baltlaminat_template/components/bitrix/catalog/services/include/facades/assets/index.js"></script>
