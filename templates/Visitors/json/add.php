<?php
echo json_encode([
    "success" => $success,
    "visitorEntity" => $visitorEntity,
    "errors" => $visitorEntity->getErrors(),
]);