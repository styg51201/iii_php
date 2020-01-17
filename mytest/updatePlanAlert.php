
</style>
        <!-- 引入 jQuery 的函式庫 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
$(document).ready(function(){
    let a = '審核';

    if(a=='審核'){
    $('input[name=status][value=審核]').prop("checked",true);
    }
})
    </script>
</style>

<form name="myForm" method="POST" action="updatePlanStatus.php">
<h3>狀態變更</h3>
<label><input type="radio" name="status" value="預設">預設</label>
<label><input type="radio" name="status" value="審核">審核</label>
<label><input type="radio" name="status" value="上架">上架</label>
<label><input type="radio" name="status" value="下架">下架</label>
    

<br><br>
<input type="hidden" name="editId" value="">
<input type="submit" class="btn btn-w-m btn-success" name="smb" value="確認">
</form>
<button class="btn btn-w-m btn-primary alertCancel">取消</button>