<div class="message error" onclick="this.classList.add('hidden');">
    <table id="innerError">
        <tr>
            <td><span class="plr5px"><i class="fa fa-warning" aria-hidden="true"></i></span></td>
            <td><?= $message ?></td>
        </tr>
    </table>
</div>

<style>
.message {
    width: 620px;
    margin: 0 auto;
    height: auto;
    padding: 8px;
    font-size: 13px;
    padding-left: 10px;
    padding-right: 10px;
    overflow: hidden;
    background: rgba(242,222,222, 0.6);
    border-radius: 7px 7px 7px 7px;
    margin-top: 5%;
}

table#innerError, table#innerError tr, table#innerError td {
    border: 0;
}

.error .plr5px i {
    font-size: 30px;
    padding: 8px;
    color: rgba(255, 17, 17, 0.44);
}

</style>
