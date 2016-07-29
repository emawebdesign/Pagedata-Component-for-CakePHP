# Pagedata-Component-for-CakePHP
get data (title, meta tags, open graph, links, images) from web page.

<h2>Requirements</h2>

HTTP Server. For example: Apache.
PHP 5.2.8 or greater.
CakePHP 2.5.1+

<h2>Installation</h2>

- upload PagedataComponent.php in the /app/Controller/Component folder

<h3>In the controller</h3>

public $components = array('Pagedata');

<h3>In the action</h3>

$url = 'http://www.emawebdesign.com';
		
echo "Title: " .$this->Pagedata->getTitle($url) ."<br>";
echo "Author: " .$this->Pagedata->getMeta($url, 'author') ."<br>";
echo "Description: " .$this->Pagedata->getMeta($url, 'description') ."<br>";
echo "Keywords: " .$this->Pagedata->getMeta($url, 'keywords') ."<br>";
echo "Twitter title: " .$this->Pagedata->getMeta($url, 'twitter:title') ."<br>";
echo "Twitter description: " .$this->Pagedata->getMeta($url, 'twitter:description') ."<br>";
echo "Twitter image: " .$this->Pagedata->getMeta($url, 'twitter:image') ."<br>";
echo "Open Graph title: " .$this->Pagedata->getOpenGraph($url, 'title') ."<br>";
echo "Open Graph description: " .$this->Pagedata->getOpenGraph($url, 'description') ."<br>";
echo "Open Graph image: " .$this->Pagedata->getOpenGraph($url, 'image') ."<br>";
echo "Body: " .$this->Pagedata->getBody($url) ."<br>";
			
print_r($this->Pagedata->getAllLinks($url)) ."<br>";
print_r($this->Pagedata->getAllImages($url)) ."<br>";

<h2>License</h2>

MIT LICENSE

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

