/**
 * Created by gongjam on 14. 9. 18.
 */
function printr_json(obj)
{
    //json형태의 데이터를 트리구조로 출력해준다.
    //사용예 : alert(printr_json(obj))
    return 	JSON.stringify( obj, null, 11 );
}