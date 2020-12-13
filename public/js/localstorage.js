jQuery (function ()
{
    // ユーザー識別情報チェック
    const user_id = localStorage.getItem('user_id')
    
    // セットされていない場合は乱数生成と登録処理
    if (user_id === null) {
        const number = createUserId()
        localStorage.setItem('user_id', number)
    }
})

function createUserId () {
    const number = Math.floor(Math.random() * (1000 - 10000)) + 10000 // とりあえず1000から10000
    return number
}