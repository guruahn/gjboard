/**
 * Javascript Functions
 *
 * @category  public
 * @package   js
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
function printr_json(obj)
{
    //print data by json form.
    //ex : alert(printr_json(obj))
    return 	JSON.stringify( obj, null, 11 );
}