<?php
function draw_board($rows, $cols) {
    $board = '<div class="board">';
    
    for($row = 1; $row <= $rows; $row++) {
        $board .= '<div class="row">';

        for($col = 1; $col <= $cols; $col++) {
            $board .= '<div class="col" id="r' . $row . 'c' . $col . '"></div>';
        }

        $board .= "</div>";
    }

    $board .= "</div>";
    echo $board;
}

function output_modal($modal_id, $modal_message) {
    echo <<< MODL
<div class="modal" id="{$modal_id}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Result</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{$modal_message}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
MODL;
}
?>