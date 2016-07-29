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
		
echo "Title: " .$this->Pagedata->getTitle($url);
echo "Author: " .$this->Pagedata->getMeta($url, 'author');
echo "Description: " .$this->Pagedata->getMeta($url, 'description');
echo "Keywords: " .$this->Pagedata->getMeta($url, 'keywords');
echo "Twitter title: " .$this->Pagedata->getMeta($url, 'twitter:title');
echo "Twitter description: " .$this->Pagedata->getMeta($url, 'twitter:description');
echo "Twitter image: " .$this->Pagedata->getMeta($url, 'twitter:image');
echo "Open Graph title: " .$this->Pagedata->getOpenGraph($url, 'title');
echo "Open Graph description: " .$this->Pagedata->getOpenGraph($url, 'description');
echo "Open Graph image: " .$this->Pagedata->getOpenGraph($url, 'image');
echo "Body: " .$this->Pagedata->getBody($url);
			
print_r($this->Pagedata->getAllLinks($url));
print_r($this->Pagedata->getAllImages($url));

<h2>License</h2>

MIT LICENSE

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

