<style type="text/css">

    .nav-justified > li, .nav-tabs.nav-justified > li {
    display: table-cell;
    width: 1%;
}
    .nav {
    list-style: outside none none;
}
    .nav-justified > li, .nav-tabs.nav-justified > li {
    float: none;
}
.nav > li > a {
    display: block;
    padding: 10px 15px;
    position: relative;
}
.form-group
{
   line-height:40px;
   width:100%;
   clear:both;
}
</style>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D" class="btn btn-default"><i class="fa fa-reply"></i> Cancel</a></div>
            <h1>Orders</h1>
            <ul class="breadcrumb">
                <li><a href="https://demo.opencart.com/admin/index.php?route=common/dashboard&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D">Home</a></li>
                <li><a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D">Orders</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> Warning: You do not have permission to access the API! <button type="button" class="close" data-dismiss="alert">×</button></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Order</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <ul id="order" class="nav nav-tabs nav-justified">
                        <li class="disabled active"><a href="#tab-customer" data-toggle="tab">1. Customer Details</a></li>
                        <li class="disabled"><a href="#tab-cart" data-toggle="tab">2. Products</a></li>
                        <li class="disabled"><a href="#tab-payment" data-toggle="tab">3. Payment Details</a></li>
                        <li class="disabled"><a href="#tab-shipping" data-toggle="tab">4. Shipping Details</a></li>
                        <li class="disabled"><a href="#tab-total" data-toggle="tab">5. Totals</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-customer">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-store">Store</label>
                                <div class="col-sm-10">
                                    <select name="store_id" id="input-store" class="form-control">
                                        <option value="0" selected="selected">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label" for="input-currency">Currency</label>
                                <div class="col-sm-10">
                                    <select name="currency" id="input-currency" class="form-control">
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">Pound Sterling</option>
                                        <option value="USD" selected="selected">US Dollar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer">Customer</label>
                                <div class="col-sm-10">
                                    <input name="customer" value=" first name first name" placeholder="Customer" id="input-customer" class="form-control" autocomplete="off" type="text"><ul class="dropdown-menu"></ul>
                                    <input name="customer_id" value="22947" type="hidden">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer-group">Customer Group</label>
                                <div class="col-sm-10">
                                    <select name="customer_group_id" id="input-customer-group" class="form-control">
                                        <option value="1" selected="selected">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
                                <div class="col-sm-10">
                                    <input name="firstname" value=" first name" id="input-firstname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                <div class="col-sm-10">
                                    <input name="lastname" value=" first name" id="input-lastname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-sm-10">
                                    <input name="email" value="firstname@seeroo.com" id="input-email" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                                <div class="col-sm-10">
                                    <input name="telephone" value=" 123456789" id="input-telephone" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" id="button-customer" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-cart">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Product</td>
                                            <td class="text-left">Model</td>
                                            <td class="text-right">Quantity</td>
                                            <td class="text-right">Unit Price</td>
                                            <td class="text-right">Total</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody id="cart">
                                        <tr>
                                            <td class="text-left">
                                                HP LP3065<br>
                                                <input name="product[0][product_id]" value="47" type="hidden">
                                                - <small>Delivery Date: 2018-12-30</small><br>
                                                <input name="product[0][option][225]" value="2018-12-30" type="hidden">
                                            </td>
                                            <td class="text-left">Product 21</td>
                                            <td class="text-right">
                                                5
                                                <input name="product[0][quantity]" value="5" type="hidden">
                                            </td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#tab-product" data-toggle="tab">Products</a></li>
                                <li><a href="#tab-voucher" data-toggle="tab">Vouchers</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-product">
                                    <fieldset>
                                        <legend>Add Product(s)</legend>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-product">Choose Product</label>
                                            <div class="col-sm-10">
                                                <input name="product" value="" id="input-product" class="form-control" autocomplete="off" type="text"><ul class="dropdown-menu"></ul>
                                                <input name="product_id" value="" type="hidden">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-quantity">Quantity</label>
                                            <div class="col-sm-10">
                                                <input name="quantity" value="1" id="input-quantity" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div id="option"></div>
                                    </fieldset>
                                    <div class="text-right">
                                        <button type="button" id="button-product-add" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Product</button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-voucher">
                                    <fieldset>
                                        <legend>Add Voucher(s)</legend>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-to-name">Recipient's Name</label>
                                            <div class="col-sm-10">
                                                <input name="to_name" value="" id="input-to-name" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-to-email">Recipient's E-mail</label>
                                            <div class="col-sm-10">
                                                <input name="to_email" value="" id="input-to-email" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-from-name">Sender's Name</label>
                                            <div class="col-sm-10">
                                                <input name="from_name" value="" id="input-from-name" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-from-email">Sender's E-mail</label>
                                            <div class="col-sm-10">
                                                <input name="from_email" value="" id="input-from-email" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-theme">Gift Certificate Theme</label>
                                            <div class="col-sm-10">
                                                <select name="voucher_theme_id" id="input-theme" class="form-control">
                                                    <option value="7">Birthday</option>
                                                    <option value="6">Christmas</option>
                                                    <option value="8">General</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-message">Message</label>
                                            <div class="col-sm-10">
                                                <textarea name="message" rows="5" id="input-message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-amount">Amount</label>
                                            <div class="col-sm-10">
                                                <input name="amount" value="1" id="input-amount" class="form-control" type="text">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-right">
                                        <button type="button" id="button-voucher-add" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Voucher</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <button type="button" onclick="$('a[href=\'#tab-customer\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" id="button-cart" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-payment">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-address">Choose Address</label>
                                <div class="col-sm-10">
                                    <select name="payment_address" id="input-payment-address" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        <option value="4727">prueba 1 apellido, kilo 1000, mexico, United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-firstname">First Name</label>
                                <div class="col-sm-10">
                                    <input name="firstname" value="prueba 1" id="input-payment-firstname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-lastname">Last Name</label>
                                <div class="col-sm-10">
                                    <input name="lastname" value="apellido" id="input-payment-lastname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-company">Company</label>
                                <div class="col-sm-10">
                                    <input name="company" value="" id="input-payment-company" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-address-1">Address 1</label>
                                <div class="col-sm-10">
                                    <input name="address_1" value="kilo 1000" id="input-payment-address-1" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-address-2">Address 2</label>
                                <div class="col-sm-10">
                                    <input name="address_2" value="" id="input-payment-address-2" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-city">City</label>
                                <div class="col-sm-10">
                                    <input name="city" value="mexico" id="input-payment-city" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-postcode">Postcode</label>
                                <div class="col-sm-10">
                                    <input name="postcode" value="06800" id="input-payment-postcode" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-country">Country</label>
                                <div class="col-sm-10">
                                    <select name="country_id" id="input-payment-country" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="244">Aaland Islands</option>
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                        <option value="7">Anguilla</option>
                                        <option value="8">Antarctica</option>
                                        <option value="9">Antigua and Barbuda</option>
                                        <option value="10">Argentina</option>
                                        <option value="11">Armenia</option>
                                        <option value="12">Aruba</option>
                                        <option value="252">Ascension Island (British)</option>
                                        <option value="13">Australia</option>
                                        <option value="14">Austria</option>
                                        <option value="15">Azerbaijan</option>
                                        <option value="16">Bahamas</option>
                                        <option value="17">Bahrain</option>
                                        <option value="18">Bangladesh</option>
                                        <option value="19">Barbados</option>
                                        <option value="20">Belarus</option>
                                        <option value="21">Belgium</option>
                                        <option value="22">Belize</option>
                                        <option value="23">Benin</option>
                                        <option value="24">Bermuda</option>
                                        <option value="25">Bhutan</option>
                                        <option value="26">Bolivia</option>
                                        <option value="245">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="27">Bosnia and Herzegovina</option>
                                        <option value="28">Botswana</option>
                                        <option value="29">Bouvet Island</option>
                                        <option value="30">Brazil</option>
                                        <option value="31">British Indian Ocean Territory</option>
                                        <option value="32">Brunei Darussalam</option>
                                        <option value="33">Bulgaria</option>
                                        <option value="34">Burkina Faso</option>
                                        <option value="35">Burundi</option>
                                        <option value="36">Cambodia</option>
                                        <option value="37">Cameroon</option>
                                        <option value="38">Canada</option>
                                        <option value="251">Canary Islands</option>
                                        <option value="39">Cape Verde</option>
                                        <option value="40">Cayman Islands</option>
                                        <option value="41">Central African Republic</option>
                                        <option value="42">Chad</option>
                                        <option value="43">Chile</option>
                                        <option value="44">China</option>
                                        <option value="45">Christmas Island</option>
                                        <option value="46">Cocos (Keeling) Islands</option>
                                        <option value="47">Colombia</option>
                                        <option value="48">Comoros</option>
                                        <option value="49">Congo</option>
                                        <option value="50">Cook Islands</option>
                                        <option value="51">Costa Rica</option>
                                        <option value="52">Cote D'Ivoire</option>
                                        <option value="53">Croatia</option>
                                        <option value="54">Cuba</option>
                                        <option value="246">Curacao</option>
                                        <option value="55">Cyprus</option>
                                        <option value="56">Czech Republic</option>
                                        <option value="237">Democratic Republic of Congo</option>
                                        <option value="57">Denmark</option>
                                        <option value="58">Djibouti</option>
                                        <option value="59">Dominica</option>
                                        <option value="60">Dominican Republic</option>
                                        <option value="61">East Timor</option>
                                        <option value="62">Ecuador</option>
                                        <option value="63">Egypt</option>
                                        <option value="64">El Salvador</option>
                                        <option value="65">Equatorial Guinea</option>
                                        <option value="66">Eritrea</option>
                                        <option value="67">Estonia</option>
                                        <option value="68">Ethiopia</option>
                                        <option value="69">Falkland Islands (Malvinas)</option>
                                        <option value="70">Faroe Islands</option>
                                        <option value="71">Fiji</option>
                                        <option value="72">Finland</option>
                                        <option value="74">France, Metropolitan</option>
                                        <option value="75">French Guiana</option>
                                        <option value="76">French Polynesia</option>
                                        <option value="77">French Southern Territories</option>
                                        <option value="126">FYROM</option>
                                        <option value="78">Gabon</option>
                                        <option value="79">Gambia</option>
                                        <option value="80">Georgia</option>
                                        <option value="81">Germany</option>
                                        <option value="82">Ghana</option>
                                        <option value="83">Gibraltar</option>
                                        <option value="84">Greece</option>
                                        <option value="85">Greenland</option>
                                        <option value="86">Grenada</option>
                                        <option value="87">Guadeloupe</option>
                                        <option value="88">Guam</option>
                                        <option value="89">Guatemala</option>
                                        <option value="256">Guernsey</option>
                                        <option value="90">Guinea</option>
                                        <option value="91">Guinea-Bissau</option>
                                        <option value="92">Guyana</option>
                                        <option value="93">Haiti</option>
                                        <option value="94">Heard and Mc Donald Islands</option>
                                        <option value="95">Honduras</option>
                                        <option value="96">Hong Kong</option>
                                        <option value="97">Hungary</option>
                                        <option value="98">Iceland</option>
                                        <option value="99">India</option>
                                        <option value="100">Indonesia</option>
                                        <option value="101">Iran (Islamic Republic of)</option>
                                        <option value="102">Iraq</option>
                                        <option value="103">Ireland</option>
                                        <option value="254">Isle of Man</option>
                                        <option value="104">Israel</option>
                                        <option value="105">Italy</option>
                                        <option value="106">Jamaica</option>
                                        <option value="107">Japan</option>
                                        <option value="257">Jersey</option>
                                        <option value="108">Jordan</option>
                                        <option value="109">Kazakhstan</option>
                                        <option value="110">Kenya</option>
                                        <option value="111">Kiribati</option>
                                        <option value="253">Kosovo, Republic of</option>
                                        <option value="114">Kuwait</option>
                                        <option value="115">Kyrgyzstan</option>
                                        <option value="116">Lao People's Democratic Republic</option>
                                        <option value="117">Latvia</option>
                                        <option value="118">Lebanon</option>
                                        <option value="119">Lesotho</option>
                                        <option value="120">Liberia</option>
                                        <option value="121">Libyan Arab Jamahiriya</option>
                                        <option value="122">Liechtenstein</option>
                                        <option value="123">Lithuania</option>
                                        <option value="124">Luxembourg</option>
                                        <option value="125">Macau</option>
                                        <option value="127">Madagascar</option>
                                        <option value="128">Malawi</option>
                                        <option value="129">Malaysia</option>
                                        <option value="130">Maldives</option>
                                        <option value="131">Mali</option>
                                        <option value="132">Malta</option>
                                        <option value="133">Marshall Islands</option>
                                        <option value="134">Martinique</option>
                                        <option value="135">Mauritania</option>
                                        <option value="136">Mauritius</option>
                                        <option value="137">Mayotte</option>
                                        <option value="138">Mexico</option>
                                        <option value="139">Micronesia, Federated States of</option>
                                        <option value="140">Moldova, Republic of</option>
                                        <option value="141">Monaco</option>
                                        <option value="142">Mongolia</option>
                                        <option value="242">Montenegro</option>
                                        <option value="143">Montserrat</option>
                                        <option value="144">Morocco</option>
                                        <option value="145">Mozambique</option>
                                        <option value="146">Myanmar</option>
                                        <option value="147">Namibia</option>
                                        <option value="148">Nauru</option>
                                        <option value="149">Nepal</option>
                                        <option value="150">Netherlands</option>
                                        <option value="151">Netherlands Antilles</option>
                                        <option value="152">New Caledonia</option>
                                        <option value="153">New Zealand</option>
                                        <option value="154">Nicaragua</option>
                                        <option value="155">Niger</option>
                                        <option value="156">Nigeria</option>
                                        <option value="157">Niue</option>
                                        <option value="158">Norfolk Island</option>
                                        <option value="112">North Korea</option>
                                        <option value="159">Northern Mariana Islands</option>
                                        <option value="160">Norway</option>
                                        <option value="161">Oman</option>
                                        <option value="162">Pakistan</option>
                                        <option value="163">Palau</option>
                                        <option value="247">Palestinian Territory, Occupied</option>
                                        <option value="164">Panama</option>
                                        <option value="165">Papua New Guinea</option>
                                        <option value="166">Paraguay</option>
                                        <option value="167">Peru</option>
                                        <option value="168">Philippines</option>
                                        <option value="169">Pitcairn</option>
                                        <option value="170">Poland</option>
                                        <option value="171">Portugal</option>
                                        <option value="172">Puerto Rico</option>
                                        <option value="173">Qatar</option>
                                        <option value="174">Reunion</option>
                                        <option value="175">Romania</option>
                                        <option value="176">Russian Federation</option>
                                        <option value="177">Rwanda</option>
                                        <option value="178">Saint Kitts and Nevis</option>
                                        <option value="179">Saint Lucia</option>
                                        <option value="180">Saint Vincent and the Grenadines</option>
                                        <option value="181">Samoa</option>
                                        <option value="182">San Marino</option>
                                        <option value="183">Sao Tome and Principe</option>
                                        <option value="184">Saudi Arabia</option>
                                        <option value="185">Senegal</option>
                                        <option value="243">Serbia</option>
                                        <option value="186">Seychelles</option>
                                        <option value="187">Sierra Leone</option>
                                        <option value="188">Singapore</option>
                                        <option value="189">Slovak Republic</option>
                                        <option value="190">Slovenia</option>
                                        <option value="191">Solomon Islands</option>
                                        <option value="192">Somalia</option>
                                        <option value="193">South Africa</option>
                                        <option value="194">South Georgia &amp; South Sandwich Islands</option>
                                        <option value="113">South Korea</option>
                                        <option value="248">South Sudan</option>
                                        <option value="195">Spain</option>
                                        <option value="196">Sri Lanka</option>
                                        <option value="249">St. Barthelemy</option>
                                        <option value="197">St. Helena</option>
                                        <option value="250">St. Martin (French part)</option>
                                        <option value="198">St. Pierre and Miquelon</option>
                                        <option value="199">Sudan</option>
                                        <option value="200">Suriname</option>
                                        <option value="201">Svalbard and Jan Mayen Islands</option>
                                        <option value="202">Swaziland</option>
                                        <option value="203">Sweden</option>
                                        <option value="204">Switzerland</option>
                                        <option value="205">Syrian Arab Republic</option>
                                        <option value="206">Taiwan</option>
                                        <option value="207">Tajikistan</option>
                                        <option value="208">Tanzania, United Republic of</option>
                                        <option value="209">Thailand</option>
                                        <option value="210">Togo</option>
                                        <option value="211">Tokelau</option>
                                        <option value="212">Tonga</option>
                                        <option value="213">Trinidad and Tobago</option>
                                        <option value="255">Tristan da Cunha</option>
                                        <option value="214">Tunisia</option>
                                        <option value="215">Turkey</option>
                                        <option value="216">Turkmenistan</option>
                                        <option value="217">Turks and Caicos Islands</option>
                                        <option value="218">Tuvalu</option>
                                        <option value="219">Uganda</option>
                                        <option value="220">Ukraine</option>
                                        <option value="221">United Arab Emirates</option>
                                        <option value="222" selected="selected">United Kingdom</option>
                                        <option value="223">United States</option>
                                        <option value="224">United States Minor Outlying Islands</option>
                                        <option value="225">Uruguay</option>
                                        <option value="226">Uzbekistan</option>
                                        <option value="227">Vanuatu</option>
                                        <option value="228">Vatican City State (Holy See)</option>
                                        <option value="229">Venezuela</option>
                                        <option value="230">Viet Nam</option>
                                        <option value="231">Virgin Islands (British)</option>
                                        <option value="232">Virgin Islands (U.S.)</option>
                                        <option value="233">Wallis and Futuna Islands</option>
                                        <option value="234">Western Sahara</option>
                                        <option value="235">Yemen</option>
                                        <option value="238">Zambia</option>
                                        <option value="239">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-payment-zone">Region / State</label>
                                <div class="col-sm-10">
                                    <select name="zone_id" id="input-payment-zone" class="form-control"><option value=""> --- Please Select --- </option><option value="3513">Aberdeen</option><option value="3514">Aberdeenshire</option><option value="3515">Anglesey</option><option value="3516">Angus</option><option value="3517">Argyll and Bute</option><option value="3518">Bedfordshire</option><option value="3519">Berkshire</option><option value="3520">Blaenau Gwent</option><option value="3521">Bridgend</option><option value="3522">Bristol</option><option value="3523">Buckinghamshire</option><option value="3524">Caerphilly</option><option value="3525">Cambridgeshire</option><option value="3526">Cardiff</option><option value="3527">Carmarthenshire</option><option value="3528">Ceredigion</option><option value="3529">Cheshire</option><option value="3530">Clackmannanshire</option><option value="3531">Conwy</option><option value="3532">Cornwall</option><option value="3949">County Antrim</option><option value="3950">County Armagh</option><option value="3951">County Down</option><option value="3952">County Fermanagh</option><option value="3953">County Londonderry</option><option value="3954">County Tyrone</option><option value="3955">Cumbria</option><option value="3533">Denbighshire</option><option value="3534">Derbyshire</option><option value="3535">Devon</option><option value="3536">Dorset</option><option value="3537">Dumfries and Galloway</option><option value="3538">Dundee</option><option value="3539">Durham</option><option value="3540">East Ayrshire</option><option value="3541">East Dunbartonshire</option><option value="3542">East Lothian</option><option value="3543">East Renfrewshire</option><option value="3544">East Riding of Yorkshire</option><option value="3545">East Sussex</option><option value="3546">Edinburgh</option><option value="3547">Essex</option><option value="3548">Falkirk</option><option value="3549">Fife</option><option value="3550">Flintshire</option><option value="3551">Glasgow</option><option value="3552">Gloucestershire</option><option value="3553">Greater London</option><option value="3554">Greater Manchester</option><option value="3555">Gwynedd</option><option value="3556">Hampshire</option><option value="3557">Herefordshire</option><option value="3558">Hertfordshire</option><option value="3559">Highlands</option><option value="3560">Inverclyde</option><option value="3561">Isle of Wight</option><option value="3562">Kent</option><option value="3563" selected="selected">Lancashire</option><option value="3564">Leicestershire</option><option value="3565">Lincolnshire</option><option value="3566">Merseyside</option><option value="3567">Merthyr Tydfil</option><option value="3568">Midlothian</option><option value="3569">Monmouthshire</option><option value="3570">Moray</option><option value="3571">Neath Port Talbot</option><option value="3572">Newport</option><option value="3573">Norfolk</option><option value="3574">North Ayrshire</option><option value="3575">North Lanarkshire</option><option value="3576">North Yorkshire</option><option value="3577">Northamptonshire</option><option value="3578">Northumberland</option><option value="3579">Nottinghamshire</option><option value="3580">Orkney Islands</option><option value="3581">Oxfordshire</option><option value="3582">Pembrokeshire</option><option value="3583">Perth and Kinross</option><option value="3584">Powys</option><option value="3585">Renfrewshire</option><option value="3586">Rhondda Cynon Taff</option><option value="3587">Rutland</option><option value="3588">Scottish Borders</option><option value="3589">Shetland Islands</option><option value="3590">Shropshire</option><option value="3591">Somerset</option><option value="3592">South Ayrshire</option><option value="3593">South Lanarkshire</option><option value="3594">South Yorkshire</option><option value="3595">Staffordshire</option><option value="3596">Stirling</option><option value="3597">Suffolk</option><option value="3598">Surrey</option><option value="3599">Swansea</option><option value="3600">Torfaen</option><option value="3601">Tyne and Wear</option><option value="3602">Vale of Glamorgan</option><option value="3603">Warwickshire</option><option value="3604">West Dunbartonshire</option><option value="3605">West Lothian</option><option value="3606">West Midlands</option><option value="3607">West Sussex</option><option value="3608">West Yorkshire</option><option value="3609">Western Isles</option><option value="3610">Wiltshire</option><option value="3611">Worcestershire</option><option value="3612">Wrexham</option></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <button type="button" onclick="$('a[href=\'#tab-cart\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" id="button-payment-address" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-shipping">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-address">Choose Address</label>
                                <div class="col-sm-10">
                                    <select name="shipping_address" id="input-shipping-address" class="form-control">
                                        <option value="0" selected="selected"> --- None --- </option>
                                        <option value="4727">prueba 1 apellido, kilo 1000, mexico, United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-firstname">First Name</label>
                                <div class="col-sm-10">
                                    <input name="firstname" value="prueba 1" id="input-shipping-firstname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-lastname">Last Name</label>
                                <div class="col-sm-10">
                                    <input name="lastname" value="apellido" id="input-shipping-lastname" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-company">Company</label>
                                <div class="col-sm-10">
                                    <input name="company" value="" id="input-shipping-company" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-address-1">Address 1</label>
                                <div class="col-sm-10">
                                    <input name="address_1" value="kilo 1000" id="input-shipping-address-1" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-address-2">Address 2</label>
                                <div class="col-sm-10">
                                    <input name="address_2" value="" id="input-shipping-address-2" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-city">City</label>
                                <div class="col-sm-10">
                                    <input name="city" value="mexico" id="input-shipping-city" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-postcode">Postcode</label>
                                <div class="col-sm-10">
                                    <input name="postcode" value="06800" id="input-shipping-postcode" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-country">Country</label>
                                <div class="col-sm-10">
                                    <select name="country_id" id="input-shipping-country" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="244">Aaland Islands</option>
                                        <option value="1">Afghanistan</option>
                                        <option value="2">Albania</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">American Samoa</option>
                                        <option value="5">Andorra</option>
                                        <option value="6">Angola</option>
                                        <option value="7">Anguilla</option>
                                        <option value="8">Antarctica</option>
                                        <option value="9">Antigua and Barbuda</option>
                                        <option value="10">Argentina</option>
                                        <option value="11">Armenia</option>
                                        <option value="12">Aruba</option>
                                        <option value="252">Ascension Island (British)</option>
                                        <option value="13">Australia</option>
                                        <option value="14">Austria</option>
                                        <option value="15">Azerbaijan</option>
                                        <option value="16">Bahamas</option>
                                        <option value="17">Bahrain</option>
                                        <option value="18">Bangladesh</option>
                                        <option value="19">Barbados</option>
                                        <option value="20">Belarus</option>
                                        <option value="21">Belgium</option>
                                        <option value="22">Belize</option>
                                        <option value="23">Benin</option>
                                        <option value="24">Bermuda</option>
                                        <option value="25">Bhutan</option>
                                        <option value="26">Bolivia</option>
                                        <option value="245">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="27">Bosnia and Herzegovina</option>
                                        <option value="28">Botswana</option>
                                        <option value="29">Bouvet Island</option>
                                        <option value="30">Brazil</option>
                                        <option value="31">British Indian Ocean Territory</option>
                                        <option value="32">Brunei Darussalam</option>
                                        <option value="33">Bulgaria</option>
                                        <option value="34">Burkina Faso</option>
                                        <option value="35">Burundi</option>
                                        <option value="36">Cambodia</option>
                                        <option value="37">Cameroon</option>
                                        <option value="38">Canada</option>
                                        <option value="251">Canary Islands</option>
                                        <option value="39">Cape Verde</option>
                                        <option value="40">Cayman Islands</option>
                                        <option value="41">Central African Republic</option>
                                        <option value="42">Chad</option>
                                        <option value="43">Chile</option>
                                        <option value="44">China</option>
                                        <option value="45">Christmas Island</option>
                                        <option value="46">Cocos (Keeling) Islands</option>
                                        <option value="47">Colombia</option>
                                        <option value="48">Comoros</option>
                                        <option value="49">Congo</option>
                                        <option value="50">Cook Islands</option>
                                        <option value="51">Costa Rica</option>
                                        <option value="52">Cote D'Ivoire</option>
                                        <option value="53">Croatia</option>
                                        <option value="54">Cuba</option>
                                        <option value="246">Curacao</option>
                                        <option value="55">Cyprus</option>
                                        <option value="56">Czech Republic</option>
                                        <option value="237">Democratic Republic of Congo</option>
                                        <option value="57">Denmark</option>
                                        <option value="58">Djibouti</option>
                                        <option value="59">Dominica</option>
                                        <option value="60">Dominican Republic</option>
                                        <option value="61">East Timor</option>
                                        <option value="62">Ecuador</option>
                                        <option value="63">Egypt</option>
                                        <option value="64">El Salvador</option>
                                        <option value="65">Equatorial Guinea</option>
                                        <option value="66">Eritrea</option>
                                        <option value="67">Estonia</option>
                                        <option value="68">Ethiopia</option>
                                        <option value="69">Falkland Islands (Malvinas)</option>
                                        <option value="70">Faroe Islands</option>
                                        <option value="71">Fiji</option>
                                        <option value="72">Finland</option>
                                        <option value="74">France, Metropolitan</option>
                                        <option value="75">French Guiana</option>
                                        <option value="76">French Polynesia</option>
                                        <option value="77">French Southern Territories</option>
                                        <option value="126">FYROM</option>
                                        <option value="78">Gabon</option>
                                        <option value="79">Gambia</option>
                                        <option value="80">Georgia</option>
                                        <option value="81">Germany</option>
                                        <option value="82">Ghana</option>
                                        <option value="83">Gibraltar</option>
                                        <option value="84">Greece</option>
                                        <option value="85">Greenland</option>
                                        <option value="86">Grenada</option>
                                        <option value="87">Guadeloupe</option>
                                        <option value="88">Guam</option>
                                        <option value="89">Guatemala</option>
                                        <option value="256">Guernsey</option>
                                        <option value="90">Guinea</option>
                                        <option value="91">Guinea-Bissau</option>
                                        <option value="92">Guyana</option>
                                        <option value="93">Haiti</option>
                                        <option value="94">Heard and Mc Donald Islands</option>
                                        <option value="95">Honduras</option>
                                        <option value="96">Hong Kong</option>
                                        <option value="97">Hungary</option>
                                        <option value="98">Iceland</option>
                                        <option value="99">India</option>
                                        <option value="100">Indonesia</option>
                                        <option value="101">Iran (Islamic Republic of)</option>
                                        <option value="102">Iraq</option>
                                        <option value="103">Ireland</option>
                                        <option value="254">Isle of Man</option>
                                        <option value="104">Israel</option>
                                        <option value="105">Italy</option>
                                        <option value="106">Jamaica</option>
                                        <option value="107">Japan</option>
                                        <option value="257">Jersey</option>
                                        <option value="108">Jordan</option>
                                        <option value="109">Kazakhstan</option>
                                        <option value="110">Kenya</option>
                                        <option value="111">Kiribati</option>
                                        <option value="253">Kosovo, Republic of</option>
                                        <option value="114">Kuwait</option>
                                        <option value="115">Kyrgyzstan</option>
                                        <option value="116">Lao People's Democratic Republic</option>
                                        <option value="117">Latvia</option>
                                        <option value="118">Lebanon</option>
                                        <option value="119">Lesotho</option>
                                        <option value="120">Liberia</option>
                                        <option value="121">Libyan Arab Jamahiriya</option>
                                        <option value="122">Liechtenstein</option>
                                        <option value="123">Lithuania</option>
                                        <option value="124">Luxembourg</option>
                                        <option value="125">Macau</option>
                                        <option value="127">Madagascar</option>
                                        <option value="128">Malawi</option>
                                        <option value="129">Malaysia</option>
                                        <option value="130">Maldives</option>
                                        <option value="131">Mali</option>
                                        <option value="132">Malta</option>
                                        <option value="133">Marshall Islands</option>
                                        <option value="134">Martinique</option>
                                        <option value="135">Mauritania</option>
                                        <option value="136">Mauritius</option>
                                        <option value="137">Mayotte</option>
                                        <option value="138">Mexico</option>
                                        <option value="139">Micronesia, Federated States of</option>
                                        <option value="140">Moldova, Republic of</option>
                                        <option value="141">Monaco</option>
                                        <option value="142">Mongolia</option>
                                        <option value="242">Montenegro</option>
                                        <option value="143">Montserrat</option>
                                        <option value="144">Morocco</option>
                                        <option value="145">Mozambique</option>
                                        <option value="146">Myanmar</option>
                                        <option value="147">Namibia</option>
                                        <option value="148">Nauru</option>
                                        <option value="149">Nepal</option>
                                        <option value="150">Netherlands</option>
                                        <option value="151">Netherlands Antilles</option>
                                        <option value="152">New Caledonia</option>
                                        <option value="153">New Zealand</option>
                                        <option value="154">Nicaragua</option>
                                        <option value="155">Niger</option>
                                        <option value="156">Nigeria</option>
                                        <option value="157">Niue</option>
                                        <option value="158">Norfolk Island</option>
                                        <option value="112">North Korea</option>
                                        <option value="159">Northern Mariana Islands</option>
                                        <option value="160">Norway</option>
                                        <option value="161">Oman</option>
                                        <option value="162">Pakistan</option>
                                        <option value="163">Palau</option>
                                        <option value="247">Palestinian Territory, Occupied</option>
                                        <option value="164">Panama</option>
                                        <option value="165">Papua New Guinea</option>
                                        <option value="166">Paraguay</option>
                                        <option value="167">Peru</option>
                                        <option value="168">Philippines</option>
                                        <option value="169">Pitcairn</option>
                                        <option value="170">Poland</option>
                                        <option value="171">Portugal</option>
                                        <option value="172">Puerto Rico</option>
                                        <option value="173">Qatar</option>
                                        <option value="174">Reunion</option>
                                        <option value="175">Romania</option>
                                        <option value="176">Russian Federation</option>
                                        <option value="177">Rwanda</option>
                                        <option value="178">Saint Kitts and Nevis</option>
                                        <option value="179">Saint Lucia</option>
                                        <option value="180">Saint Vincent and the Grenadines</option>
                                        <option value="181">Samoa</option>
                                        <option value="182">San Marino</option>
                                        <option value="183">Sao Tome and Principe</option>
                                        <option value="184">Saudi Arabia</option>
                                        <option value="185">Senegal</option>
                                        <option value="243">Serbia</option>
                                        <option value="186">Seychelles</option>
                                        <option value="187">Sierra Leone</option>
                                        <option value="188">Singapore</option>
                                        <option value="189">Slovak Republic</option>
                                        <option value="190">Slovenia</option>
                                        <option value="191">Solomon Islands</option>
                                        <option value="192">Somalia</option>
                                        <option value="193">South Africa</option>
                                        <option value="194">South Georgia &amp; South Sandwich Islands</option>
                                        <option value="113">South Korea</option>
                                        <option value="248">South Sudan</option>
                                        <option value="195">Spain</option>
                                        <option value="196">Sri Lanka</option>
                                        <option value="249">St. Barthelemy</option>
                                        <option value="197">St. Helena</option>
                                        <option value="250">St. Martin (French part)</option>
                                        <option value="198">St. Pierre and Miquelon</option>
                                        <option value="199">Sudan</option>
                                        <option value="200">Suriname</option>
                                        <option value="201">Svalbard and Jan Mayen Islands</option>
                                        <option value="202">Swaziland</option>
                                        <option value="203">Sweden</option>
                                        <option value="204">Switzerland</option>
                                        <option value="205">Syrian Arab Republic</option>
                                        <option value="206">Taiwan</option>
                                        <option value="207">Tajikistan</option>
                                        <option value="208">Tanzania, United Republic of</option>
                                        <option value="209">Thailand</option>
                                        <option value="210">Togo</option>
                                        <option value="211">Tokelau</option>
                                        <option value="212">Tonga</option>
                                        <option value="213">Trinidad and Tobago</option>
                                        <option value="255">Tristan da Cunha</option>
                                        <option value="214">Tunisia</option>
                                        <option value="215">Turkey</option>
                                        <option value="216">Turkmenistan</option>
                                        <option value="217">Turks and Caicos Islands</option>
                                        <option value="218">Tuvalu</option>
                                        <option value="219">Uganda</option>
                                        <option value="220">Ukraine</option>
                                        <option value="221">United Arab Emirates</option>
                                        <option value="222" selected="selected">United Kingdom</option>
                                        <option value="223">United States</option>
                                        <option value="224">United States Minor Outlying Islands</option>
                                        <option value="225">Uruguay</option>
                                        <option value="226">Uzbekistan</option>
                                        <option value="227">Vanuatu</option>
                                        <option value="228">Vatican City State (Holy See)</option>
                                        <option value="229">Venezuela</option>
                                        <option value="230">Viet Nam</option>
                                        <option value="231">Virgin Islands (British)</option>
                                        <option value="232">Virgin Islands (U.S.)</option>
                                        <option value="233">Wallis and Futuna Islands</option>
                                        <option value="234">Western Sahara</option>
                                        <option value="235">Yemen</option>
                                        <option value="238">Zambia</option>
                                        <option value="239">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-shipping-zone">Region / State</label>
                                <div class="col-sm-10">
                                    <select name="zone_id" id="input-shipping-zone" class="form-control"><option value=""> --- Please Select --- </option><option value="3513">Aberdeen</option><option value="3514">Aberdeenshire</option><option value="3515">Anglesey</option><option value="3516">Angus</option><option value="3517">Argyll and Bute</option><option value="3518">Bedfordshire</option><option value="3519">Berkshire</option><option value="3520">Blaenau Gwent</option><option value="3521">Bridgend</option><option value="3522">Bristol</option><option value="3523">Buckinghamshire</option><option value="3524">Caerphilly</option><option value="3525">Cambridgeshire</option><option value="3526">Cardiff</option><option value="3527">Carmarthenshire</option><option value="3528">Ceredigion</option><option value="3529">Cheshire</option><option value="3530">Clackmannanshire</option><option value="3531">Conwy</option><option value="3532">Cornwall</option><option value="3949">County Antrim</option><option value="3950">County Armagh</option><option value="3951">County Down</option><option value="3952">County Fermanagh</option><option value="3953">County Londonderry</option><option value="3954">County Tyrone</option><option value="3955">Cumbria</option><option value="3533">Denbighshire</option><option value="3534">Derbyshire</option><option value="3535">Devon</option><option value="3536">Dorset</option><option value="3537">Dumfries and Galloway</option><option value="3538">Dundee</option><option value="3539">Durham</option><option value="3540">East Ayrshire</option><option value="3541">East Dunbartonshire</option><option value="3542">East Lothian</option><option value="3543">East Renfrewshire</option><option value="3544">East Riding of Yorkshire</option><option value="3545">East Sussex</option><option value="3546">Edinburgh</option><option value="3547">Essex</option><option value="3548">Falkirk</option><option value="3549">Fife</option><option value="3550">Flintshire</option><option value="3551">Glasgow</option><option value="3552">Gloucestershire</option><option value="3553">Greater London</option><option value="3554">Greater Manchester</option><option value="3555">Gwynedd</option><option value="3556">Hampshire</option><option value="3557">Herefordshire</option><option value="3558">Hertfordshire</option><option value="3559">Highlands</option><option value="3560">Inverclyde</option><option value="3561">Isle of Wight</option><option value="3562">Kent</option><option value="3563" selected="selected">Lancashire</option><option value="3564">Leicestershire</option><option value="3565">Lincolnshire</option><option value="3566">Merseyside</option><option value="3567">Merthyr Tydfil</option><option value="3568">Midlothian</option><option value="3569">Monmouthshire</option><option value="3570">Moray</option><option value="3571">Neath Port Talbot</option><option value="3572">Newport</option><option value="3573">Norfolk</option><option value="3574">North Ayrshire</option><option value="3575">North Lanarkshire</option><option value="3576">North Yorkshire</option><option value="3577">Northamptonshire</option><option value="3578">Northumberland</option><option value="3579">Nottinghamshire</option><option value="3580">Orkney Islands</option><option value="3581">Oxfordshire</option><option value="3582">Pembrokeshire</option><option value="3583">Perth and Kinross</option><option value="3584">Powys</option><option value="3585">Renfrewshire</option><option value="3586">Rhondda Cynon Taff</option><option value="3587">Rutland</option><option value="3588">Scottish Borders</option><option value="3589">Shetland Islands</option><option value="3590">Shropshire</option><option value="3591">Somerset</option><option value="3592">South Ayrshire</option><option value="3593">South Lanarkshire</option><option value="3594">South Yorkshire</option><option value="3595">Staffordshire</option><option value="3596">Stirling</option><option value="3597">Suffolk</option><option value="3598">Surrey</option><option value="3599">Swansea</option><option value="3600">Torfaen</option><option value="3601">Tyne and Wear</option><option value="3602">Vale of Glamorgan</option><option value="3603">Warwickshire</option><option value="3604">West Dunbartonshire</option><option value="3605">West Lothian</option><option value="3606">West Midlands</option><option value="3607">West Sussex</option><option value="3608">West Yorkshire</option><option value="3609">Western Isles</option><option value="3610">Wiltshire</option><option value="3611">Worcestershire</option><option value="3612">Wrexham</option></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <button type="button" onclick="$('a[href=\'#tab-payment\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" id="button-shipping-address" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-total">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Product</td>
                                            <td class="text-left">Model</td>
                                            <td class="text-right">Quantity</td>
                                            <td class="text-right">Unit Price</td>
                                            <td class="text-right">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody id="total">
                                        <tr>
                                            <td class="text-center" colspan="5">No results!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <fieldset>
                                <legend>Order Details</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-shipping-method">Shipping Method</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select name="shipping_method" id="input-shipping-method" class="form-control">
                                                <option value=""> --- Please Select --- </option>
                                                <option value="flat.flat" selected="selected">Flat Shipping Rate</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" id="button-shipping-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-payment-method">Payment Method</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select name="payment_method" id="input-payment-method" class="form-control">
                                                <option value=""> --- Please Select --- </option>
                                                <option value="cod" selected="selected">Cash On Delivery</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" id="button-payment-method" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-coupon">Coupon</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="coupon" value="" id="input-coupon" class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-voucher">Voucher</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="voucher" value="" id="input-voucher" data-loading-text="Loading..." class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-reward">Reward</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input name="reward" value="" id="input-reward" data-loading-text="Loading..." class="form-control" type="text">
                                            <span class="input-group-btn">
                                                <button type="button" id="button-reward" data-loading-text="Loading..." class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
                                    <div class="col-sm-10">
                                        <select name="order_status_id" id="input-order-status" class="form-control">
                                            <option value="7">Canceled</option>
                                            <option value="9">Canceled Reversal</option>
                                            <option value="13">Chargeback</option>
                                            <option value="5">Complete</option>
                                            <option value="8">Denied</option>
                                            <option value="14">Expired</option>
                                            <option value="10">Failed</option>
                                            <option value="1" selected="selected">Pending</option>
                                            <option value="15">Processed</option>
                                            <option value="2">Processing</option>
                                            <option value="11">Refunded</option>
                                            <option value="12">Reversed</option>
                                            <option value="3">Shipped</option>
                                            <option value="16">Voided</option>
                                        </select>
                                        <input name="order_id" value="4448" type="hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-comment">Comment</label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" rows="5" id="input-comment" class="form-control">cash</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-affiliate">Affiliate</label>
                                    <div class="col-sm-10">
                                        <input name="affiliate" value=" " id="input-affiliate" class="form-control" autocomplete="off" type="text"><ul class="dropdown-menu"></ul>
                                        <input name="affiliate_id" value="0" type="hidden">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <button type="button" onclick="$('select[name=\'shipping_method\']').prop('disabled') ? $('a[href=\'#tab-payment\']').tab('show') : $('a[href=\'#tab-shipping\']').tab('show');" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" id="button-refresh" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-warning" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
                                    <button type="button" id="button-save" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
&lt;!--
// Disable the tabs
$('#order a[data-toggle=\'tab\']').on('click', function(e) {
	return false;
});

// Currency
$('select[name=\'currency\']').on('change', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/currency&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'currency=' + $('select[name=\'currency\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('select[name=\'currency\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'currency\']').prop('disabled', false);
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'currency\']').closest('.form-group').addClass('has-error');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'currency\']').trigger('change');

// Customer
$('input[name=\'customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=customer/customer/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					customer_id: '0',
					customer_group_id: '1',
					name: ' --- None --- ',
					customer_group: '',
					firstname: '',
					lastname: '',
					email: '',
					telephone: '',
					custom_field: [],
					address: []
				});

				response($.map(json, function(item) {
					return {
						category: item['customer_group'],
						label: item['name'],
						value: item['customer_id'],
						customer_group_id: item['customer_group_id'],
						firstname: item['firstname'],
						lastname: item['lastname'],
						email: item['email'],
						telephone: item['telephone'],
						custom_field: item['custom_field'],
						address: item['address']
					}
				}));
			}
		});
	},
	'select': function(item) {
		// Reset all custom fields
		$('#tab-customer input[type=\'text\'], #tab-customer textarea').not('#tab-customer input[name=\'customer\'], #tab-customer input[name=\'customer_id\']').val('');
		$('#tab-customer select option').not($('#tab-customer select[name=\'store_id\'] option, #tab-customer select[name=\'currency\'] option')).removeAttr('selected');
		$('#tab-customer input[type=\'checkbox\'], #tab-customer input[type=\'radio\']').removeAttr('checked');

		$('#tab-customer input[name=\'customer\']').val(item['label']);
		$('#tab-customer input[name=\'customer_id\']').val(item['value']);
		$('#tab-customer select[name=\'customer_group_id\']').val(item['customer_group_id']);
		$('#tab-customer input[name=\'firstname\']').val(item['firstname']);
		$('#tab-customer input[name=\'lastname\']').val(item['lastname']);
		$('#tab-customer input[name=\'email\']').val(item['email']);
		$('#tab-customer input[name=\'telephone\']').val(item['telephone']);

		for (i in item.custom_field) {
			$('#tab-customer select[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer textarea[name=\'custom_field[' + i + ']\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(item.custom_field[i]);
			$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + item.custom_field[i] + '\']').prop('checked', true);

			if (item.custom_field[i] instanceof Array) {
				for (j = 0; j &lt; item.custom_field[i].length; j++) {
					$('#tab-customer input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + item.custom_field[i][j] + '\']').prop('checked', true);
				}
			}
		}

		$('select[name=\'customer_group_id\']').trigger('change');

		html = '&lt;option value="0"&gt; --- None --- &lt;/option&gt;';

		for (i in  item['address']) {
			html += '&lt;option value="' + item['address'][i]['address_id'] + '"&gt;' + item['address'][i]['firstname'] + ' ' + item['address'][i]['lastname'] + ', ' + item['address'][i]['address_1'] + ', ' + item['address'][i]['city'] + ', ' + item['address'][i]['country'] + '&lt;/option&gt;';
		}

		$('select[name=\'payment_address\']').html(html);
		$('select[name=\'shipping_address\']').html(html);
	}
});

// Custom Fields
$('select[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/customfield&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i &lt; json.length; i++) {
				custom_field = json[i];

				$('.custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('.custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'customer_group_id\']').trigger('change');

$('#button-customer').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/customer&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-customer input[type=\'text\'], #tab-customer input[type=\'hidden\'], #tab-customer input[type=\'radio\']:checked, #tab-customer input[type=\'checkbox\']:checked, #tab-customer select, #tab-customer textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-customer').button('loading');
		},
		complete: function() {
			 $('#button-customer').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-' + i.replace('_', '-'));

					if (element.parent().hasClass('input-group')) {
                   		$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
                // Refresh products, vouchers and totals
                var request_1 = $.ajax({
                    url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
                    type: 'post',
                    data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
                    dataType: 'json',
                    crossDomain: true,
                    beforeSend: function() {
                        $('#button-product-add').button('loading');
                    },
                    complete: function() {
                        $('#button-product-add').button('reset');
                    },
                    success: function(json) {
                        $('.alert-dismissible, .text-danger').remove();
                        $('.form-group').removeClass('has-error');

                        if (json['error'] &amp;&amp; json['error']['warning']) {
                            $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
                        }
            		},
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

                var request_2 = request_1.then(function() {
                    $.ajax({
                        url: 'https://demo.opencart.com/index.php?route=api/voucher/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
                        type: 'post',
                        data: $('#cart input[name^=\'voucher\'][type=\'text\'], #cart input[name^=\'voucher\'][type=\'hidden\'], #cart input[name^=\'voucher\'][type=\'radio\']:checked, #cart input[name^=\'voucher\'][type=\'checkbox\']:checked, #cart select[name^=\'voucher\'], #cart textarea[name^=\'voucher\']'),
                        dataType: 'json',
                        crossDomain: true,
                        beforeSend: function() {
                            $('#button-voucher-add').button('loading');
                        },
                        complete: function() {
                            $('#button-voucher-add').button('reset');
                        },
                        success: function(json) {
                            $('.alert-dismissible, .text-danger').remove();
                            $('.form-group').removeClass('has-error');

                            if (json['error'] &amp;&amp; json['error']['warning']) {
                                $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
                            }
                		},
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                });

                request_2.done(function() {
                    $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-cart\']').tab('show');
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-product input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id'],
						model: item['model'],
						option: item['option'],
						price: item['price']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('#tab-product input[name=\'product\']').val(item['label']);
		$('#tab-product input[name=\'product_id\']').val(item['value']);

		if (item['option'] != '') {
 			html  = '&lt;fieldset&gt;';
            html += '  &lt;legend&gt;Choose Option(s)&lt;/legend&gt;';

			for (i = 0; i &lt; item['option'].length; i++) {
				option = item['option'][i];

				if (option['type'] == 'select') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'radio') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'checkbox') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;div id="input-option' + option['product_option_id'] + '"&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;div class="checkbox"&gt;';

						html += '  &lt;label&gt;&lt;input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" /&gt; ' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '  &lt;/label&gt;';
						html += '&lt;/div&gt;';
					}

					html += '    &lt;/div&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'image') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;select name="option[' + option['product_option_id'] + ']" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;';
					html += '      &lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

					for (j = 0; j &lt; option['product_option_value'].length; j++) {
						option_value = option['product_option_value'][j];

						html += '&lt;option value="' + option_value['product_option_value_id'] + '"&gt;' + option_value['name'];

						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}

						html += '&lt;/option&gt;';
					}

					html += '    &lt;/select&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'text') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'textarea') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;&lt;textarea name="option[' + option['product_option_id'] + ']" rows="5" id="input-option' + option['product_option_id'] + '" class="form-control"&gt;' + option['value'] + '&lt;/textarea&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'file') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-10"&gt;';
					html += '    &lt;button type="button" id="button-upload' + option['product_option_id'] + '" data-loading-text="Loading..." class="btn btn-default"&gt;&lt;i class="fa fa-upload"&gt;&lt;/i&gt; Upload&lt;/button&gt;';
					html += '    &lt;input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" id="input-option' + option['product_option_id'] + '" /&gt;';
					html += '  &lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'date') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group date"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'datetime') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group datetime"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="YYYY-MM-DD HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}

				if (option['type'] == 'time') {
					html += '&lt;div class="form-group' + (option['required'] ? ' required' : '') + '"&gt;';
					html += '  &lt;label class="col-sm-2 control-label" for="input-option' + option['product_option_id'] + '"&gt;' + option['name'] + '&lt;/label&gt;';
					html += '  &lt;div class="col-sm-3"&gt;&lt;div class="input-group time"&gt;&lt;input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['value'] + '" placeholder="' + option['name'] + '" data-date-format="HH:mm" id="input-option' + option['product_option_id'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" class="btn btn-default"&gt;&lt;i class="fa fa-calendar"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;';
					html += '&lt;/div&gt;';
				}
			}

			html += '&lt;/fieldset&gt;';

			$('#option').html(html);

			$('.date').datetimepicker({
				language: 'en-gb',
				pickTime: false
			});

			$('.datetime').datetimepicker({
				language: 'en-gb',
				pickDate: true,
				pickTime: true
			});

			$('.time').datetimepicker({
				language: 'en-gb',
				pickDate: false
			});
		} else {
			$('#option').html('');
		}
	}
});

$('#button-product-add').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-product input[name=\'product_id\'], #tab-product input[name=\'quantity\'], #tab-product input[name^=\'option\'][type=\'text\'], #tab-product input[name^=\'option\'][type=\'hidden\'], #tab-product input[name^=\'option\'][type=\'radio\']:checked, #tab-product input[name^=\'option\'][type=\'checkbox\']:checked, #tab-product select[name^=\'option\'], #tab-product textarea[name^=\'option\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-product-add').button('loading');
		},
		complete: function() {
			$('#button-product-add').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error']['option'][i] + '&lt;/div&gt;');
						} else {
							$(element).after('&lt;div class="text-danger"&gt;' + json['error']['option'][i] + '&lt;/div&gt;');
						}
					}
				}

				if (json['error']['store']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['store'] + '&lt;/div&gt;');
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Voucher
$('#button-voucher-add').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/voucher/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-voucher-add').button('loading');
		},
		complete: function() {
			$('#button-voucher-add').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-' + i.replace('_', '-'));

					if (element.parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				$('input[name=\'from_name\']').val('');
				$('input[name=\'from_email\']').val('');
				$('input[name=\'to_name\']').val('');
				$('input[name=\'to_email\']').val('');
				$('textarea[name=\'message\']').val('');
				$('input[name=\'amount\']').val('1');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#cart').delegate('.btn-danger', 'click', function() {
	var node = this;

	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/cart/remove&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'key=' + encodeURIComponent(this.value),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$(node).button('loading');
		},
		complete: function() {
			$(node).button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();

			// Check for errors
			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			} else {
				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#cart').delegate('.btn-primary', 'click', function() {
    var node = this;

    // Refresh products, vouchers and totals
    $.ajax({
        url: 'https://demo.opencart.com/index.php?route=api/cart/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
        type: 'post',
        data: $('#cart input[name^=\'product\'][type=\'text\'], #cart input[name^=\'product\'][type=\'hidden\'], #cart input[name^=\'product\'][type=\'radio\']:checked, #cart input[name^=\'product\'][type=\'checkbox\']:checked, #cart select[name^=\'product\'], #cart textarea[name^=\'product\']'),
        dataType: 'json',
        crossDomain: true,
        beforeSend: function() {
            $(node).button('loading');
        },
        complete: function() {
            $(node).button('reset');
        },
        success: function(json) {
            $('.alert-dismissible, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['error'] &amp;&amp; json['error']['warning']) {
                $('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
            }

            if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    }).done(function() {
        $('#button-refresh').trigger('click');
    });
});

$('#button-cart').on('click', function() {
	$('a[href=\'#tab-payment\']').tab('show');
});

// Payment Address
$('select[name=\'payment_address\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/address&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;address_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'payment_address\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'payment_address\']').prop('disabled', false);
		},
		success: function(json) {
			// Reset all fields
			$('#tab-payment input[type=\'text\'], #tab-payment input[type=\'text\'], #tab-payment textarea').val('');
			$('#tab-payment select option').not('#tab-payment select[name=\'payment_address\']').removeAttr('selected');
			$('#tab-payment input[type=\'checkbox\'], #tab-payment input[type=\'radio\']').removeAttr('checked');

			$('#tab-payment input[name=\'firstname\']').val(json['firstname']);
			$('#tab-payment input[name=\'lastname\']').val(json['lastname']);
			$('#tab-payment input[name=\'company\']').val(json['company']);
			$('#tab-payment input[name=\'address_1\']').val(json['address_1']);
			$('#tab-payment input[name=\'address_2\']').val(json['address_2']);
			$('#tab-payment input[name=\'city\']').val(json['city']);
			$('#tab-payment input[name=\'postcode\']').val(json['postcode']);
			$('#tab-payment select[name=\'country_id\']').val(json['country_id']);

			payment_zone_id = json['zone_id'];

			for (i in json['custom_field']) {
				$('#tab-payment select[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment textarea[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(json['custom_field'][i]);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);
				$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);

				if (json['custom_field'][i] instanceof Array) {
					for (j = 0; j &lt; json['custom_field'][i].length; j++) {
						$('#tab-payment input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i][j] + '\']').prop('checked', true);
					}
				}
			}

			$('#tab-payment select[name=\'country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

var payment_zone_id = '3563';

$('#tab-payment select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/country/country&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-payment select[name=\'country_id\']').after(' &lt;i class="fa fa-circle-o-notch fa-spin"&gt;&lt;/i&gt;');
		},
		complete: function() {
			$('#tab-payment .fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#tab-payment input[name=\'postcode\']').closest('.form-group').addClass('required');
			} else {
				$('#tab-payment input[name=\'postcode\']').closest('.form-group').removeClass('required');
			}

			html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

			if (json['zone'] &amp;&amp; json['zone'] != '') {
				for (i = 0; i &lt; json['zone'].length; i++) {
        			html += '&lt;option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == payment_zone_id) {
	      				html += ' selected="selected"';
	    			}

	    			html += '&gt;' + json['zone'][i]['name'] + '&lt;/option&gt;';
				}
			} else {
				html += '&lt;option value="0" selected="selected"&gt; --- None --- &lt;/option&gt;';
			}

			$('#tab-payment select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-payment select[name=\'country_id\']').trigger('change');

$('#button-payment-address').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/payment/address&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-payment input[type=\'text\'], #tab-payment input[type=\'hidden\'], #tab-payment input[type=\'radio\']:checked, #tab-payment input[type=\'checkbox\']:checked, #tab-payment select, #tab-payment textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-payment-address').button('loading');
		},
		complete: function() {
			$('#button-payment-address').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Payment Methods
				$.ajax({
					url: 'https://demo.opencart.com/index.php?route=api/payment/methods&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
					dataType: 'json',
					crossDomain: true,
					beforeSend: function() {
						$('#button-payment-address').button('loading');
					},
					complete: function() {
						$('#button-payment-address').button('reset');
					},
					success: function(json) {
						if (json['error']) {
							$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
						} else {
							html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

							if (json['payment_methods']) {
								for (i in json['payment_methods']) {
									if (json['payment_methods'][i]['code'] == $('select[name=\'payment_method\'] option:selected').val()) {
										html += '&lt;option value="' + json['payment_methods'][i]['code'] + '" selected="selected"&gt;' + json['payment_methods'][i]['title'] + '&lt;/option&gt;';
									} else {
										html += '&lt;option value="' + json['payment_methods'][i]['code'] + '"&gt;' + json['payment_methods'][i]['title'] + '&lt;/option&gt;';
									}
								}
							}

							$('select[name=\'payment_method\']').html(html);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				}).done(function() {
                    // Refresh products, vouchers and totals
    				$('#button-refresh').trigger('click');

    				// If shipping required got to shipping tab else total tabs
    				if ($('select[name=\'shipping_method\']').prop('disabled')) {
    					$('a[href=\'#tab-total\']').tab('show');
    				} else {
    					$('a[href=\'#tab-shipping\']').tab('show');
    				}
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Shipping Address
$('select[name=\'shipping_address\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/address&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;address_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'shipping_address\']').prop('disabled', true);
		},
		complete: function() {
			$('select[name=\'shipping_address\']').prop('disabled', false);
		},
		success: function(json) {
			// Reset all fields
			$('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'text\'], #tab-shipping textarea').val('');
			$('#tab-shipping select option').not('#tab-shipping select[name=\'shipping_address\']').removeAttr('selected');
			$('#tab-shipping input[type=\'checkbox\'], #tab-shipping input[type=\'radio\']').removeAttr('checked');

			$('#tab-shipping input[name=\'firstname\']').val(json['firstname']);
			$('#tab-shipping input[name=\'lastname\']').val(json['lastname']);
			$('#tab-shipping input[name=\'company\']').val(json['company']);
			$('#tab-shipping input[name=\'address_1\']').val(json['address_1']);
			$('#tab-shipping input[name=\'address_2\']').val(json['address_2']);
			$('#tab-shipping input[name=\'city\']').val(json['city']);
			$('#tab-shipping input[name=\'postcode\']').val(json['postcode']);
			$('#tab-shipping select[name=\'country_id\']').val(json['country_id']);

			shipping_zone_id = json['zone_id'];

			for (i in json['custom_field']) {
				$('#tab-shipping select[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-shipping textarea[name=\'custom_field[' + i + ']\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'text\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'hidden\']').val(json['custom_field'][i]);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'radio\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);
				$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i] + '\']').prop('checked', true);

				if (json['custom_field'][i] instanceof Array) {
					for (j = 0; j &lt; json['custom_field'][i].length; j++) {
						$('#tab-shipping input[name^=\'custom_field[' + i + ']\'][type=\'checkbox\'][value=\'' + json['custom_field'][i][j] + '\']').prop('checked', true);
					}
				}
			}

			$('#tab-shipping select[name=\'country_id\']').trigger('change');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

var shipping_zone_id = '3563';

$('#tab-shipping select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/country/country&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#tab-shipping select[name=\'country_id\']').prop('disabled', true);
		},
		complete: function() {
			$('#tab-shipping select[name=\'country_id\']').prop('disabled', false);
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#tab-shipping input[name=\'postcode\']').closest('.form-group').addClass('required');
			} else {
				$('#tab-shipping input[name=\'postcode\']').closest('.form-group').removeClass('required');
			}

			html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

			if (json['zone'] &amp;&amp; json['zone'] != '') {
				for (i = 0; i &lt; json['zone'].length; i++) {
        			html += '&lt;option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == shipping_zone_id) {
	      				html += ' selected="selected"';
	    			}

	    			html += '&gt;' + json['zone'][i]['name'] + '&lt;/option&gt;';
				}
			} else {
				html += '&lt;option value="0" selected="selected"&gt; --- None --- &lt;/option&gt;';
			}

			$('#tab-shipping select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#tab-shipping select[name=\'country_id\']').trigger('change');

$('#button-shipping-address').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/shipping/address&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: $('#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'hidden\'], #tab-shipping input[type=\'radio\']:checked, #tab-shipping input[type=\'checkbox\']:checked, #tab-shipping select, #tab-shipping textarea'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-shipping-address').button('loading');
		},
		complete: function() {
			$('#button-shipping-address').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				for (i in json['error']) {
					var element = $('#input-shipping-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					} else {
						$(element).after('&lt;div class="text-danger"&gt;' + json['error'][i] + '&lt;/div&gt;');
					}
				}

				// Highlight any found errors
				$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
			} else {
				// Shipping Methods
				var request = $.ajax({
					url: 'https://demo.opencart.com/index.php?route=api/shipping/methods&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
					dataType: 'json',
					beforeSend: function() {
						$('#button-shipping-address').button('loading');
					},
					complete: function() {
						$('#button-shipping-address').button('reset');
					},
					success: function(json) {
						if (json['error']) {
							$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
						} else {
							// Shipping Methods
							html = '&lt;option value=""&gt; --- Please Select --- &lt;/option&gt;';

							if (json['shipping_methods']) {
								for (i in json['shipping_methods']) {
									html += '&lt;optgroup label="' + json['shipping_methods'][i]['title'] + '"&gt;';

									if (!json['shipping_methods'][i]['error']) {
										for (j in json['shipping_methods'][i]['quote']) {
											if (json['shipping_methods'][i]['quote'][j]['code'] == $('select[name=\'shipping_method\'] option:selected').val()) {
												html += '&lt;option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '" selected="selected"&gt;' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '&lt;/option&gt;';
											} else {
												html += '&lt;option value="' + json['shipping_methods'][i]['quote'][j]['code'] + '"&gt;' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '&lt;/option&gt;';
											}
										}
									} else {
										html += '&lt;option value="" style="color: #F00;" disabled="disabled"&gt;' + json['shipping_method'][i]['error'] + '&lt;/option&gt;';
									}

									html += '&lt;/optgroup&gt;';
								}
							}

							$('select[name=\'shipping_method\']').html(html);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				}).done(function() {
				    // Refresh products, vouchers and totals
				    $('#button-refresh').trigger('click');

                    $('a[href=\'#tab-total\']').tab('show');
                });
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Shipping Method
$('#button-shipping-method').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/shipping/method&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'shipping_method=' + $('select[name=\'shipping_method\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-shipping-method').button('loading');
		},
		complete: function() {
			$('#button-shipping-method').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'shipping_method\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Payment Method
$('#button-payment-method').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/payment/method&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'payment_method=' + $('select[name=\'payment_method\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-payment-method').button('loading');
		},
		complete: function() {
			$('#button-payment-method').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('select[name=\'payment_method\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Coupon
$('#button-coupon').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/coupon&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'coupon=' + $('input[name=\'coupon\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-coupon').button('loading');
		},
		complete: function() {
			$('#button-coupon').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'coupon\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Voucher
$('#button-voucher').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/voucher&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'voucher=' + $('input[name=\'voucher\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-voucher').button('loading');
		},
		complete: function() {
			$('#button-voucher').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'voucher\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Reward
$('#button-reward').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/reward&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		type: 'post',
		data: 'reward=' + $('input[name=\'reward\']').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-reward').button('loading');
		},
		complete: function() {
			$('#button-reward').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Highlight any found errors
				$('input[name=\'reward\']').closest('.form-group').addClass('has-error');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');

				// Refresh products, vouchers and totals
				$('#button-refresh').trigger('click');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Affiliate
$('input[name=\'affiliate\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=marketing/affiliate/autocomplete&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D&amp;filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					affiliate_id: 0,
					name: ' --- None --- '
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['affiliate_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'affiliate\']').val(item['label']);
		$('input[name=\'affiliate_id\']').val(item['value']);
	}
});

// Checkout
$('#button-save').on('click', function() {
	if ($('input[name=\'order_id\']').val() == 0) {
		var url = 'https://demo.opencart.com/index.php?route=api/order/add&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val();
	} else {
		var url = 'https://demo.opencart.com/index.php?route=api/order/edit&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val() + '&amp;order_id=' + $('input[name=\'order_id\']').val();
	}

	$.ajax({
		url: url,
		type: 'post',
		data: $('select[name=\'payment_method\'] option:selected, select[name=\'shipping_method\'] option:selected,  #tab-total select[name=\'order_status_id\'], #tab-total select, textarea[name=\'comment\'], input[name=\'affiliate_id\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-save').button('loading');
		},
		complete: function() {
			$('#button-save').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible, .text-danger').remove();

			if (json['error']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
			}

			if (json['success']) {
				$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-success alert-dismissible"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt; ' + json['success'] + '  &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
            }

			if (json['order_id']) {
				$('input[name=\'order_id\']').val(json['order_id']);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#content').delegate('button[id^=\'button-upload\'], button[id^=\'button-custom-field\'], button[id^=\'button-payment-custom-field\'], button[id^=\'button-shipping-custom-field\']', 'click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('&lt;form enctype="multipart/form-data" id="form-upload" style="display: none;"&gt;&lt;input type="file" name="file" /&gt;&lt;/form&gt;');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload/upload&amp;user_token=ULi7h0A9VXa6CSampGlVL4xvj76k9Q2D',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input[type=\'hidden\']').after('&lt;div class="text-danger"&gt;' + json['error'] + '&lt;/div&gt;');
					}

					if (json['success']) {
						alert(json['success']);
					}

					if (json['code']) {
						$(node).parent().find('input[type=\'hidden\']').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('.date').datetimepicker({
	language: 'en-gb',
	pickTime: false
});

$('.datetime').datetimepicker({
	language: 'en-gb',
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	language: 'en-gb',
	pickDate: false
});
//--&gt;</script>
    <script type="text/javascript">
// Sort the custom fields
$('#tab-customer .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') &gt;= 0 &amp;&amp; $(this).attr('data-sort') &lt;= $('#tab-customer .form-group').length) {
		$('#tab-customer .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') &gt; $('#tab-customer .form-group').length) {
		$('#tab-customer .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') &lt; -$('#tab-customer .form-group').length) {
		$('#tab-customer .form-group:first').before(this);
	}
});

// Sort the custom fields
$('#tab-payment .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') &gt;= 0 &amp;&amp; $(this).attr('data-sort') &lt;= $('#tab-payment .form-group').length) {
		$('#tab-payment .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') &gt; $('#tab-payment .form-group').length) {
		$('#tab-payment .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') &lt; -$('#tab-payment .form-group').length) {
		$('#tab-payment .form-group:first').before(this);
	}
});

$('#tab-shipping .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') &gt;= 0 &amp;&amp; $(this).attr('data-sort') &lt;= $('#tab-shipping .form-group').length) {
		$('#tab-shipping .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') &gt; $('#tab-shipping .form-group').length) {
		$('#tab-shipping .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') &lt; -$('#tab-shipping .form-group').length) {
		$('#tab-shipping .form-group:first').before(this);
	}
});

// Add all products to the cart using the api
$('#button-refresh').on('click', function() {
	$.ajax({
		url: 'https://demo.opencart.com/index.php?route=api/cart/products&amp;api_token=&amp;store_id=' + $('select[name=\'store_id\'] option:selected').val(),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
			$('#button-refresh').button('loading');
		},
		complete: function() {
			$('#button-refresh').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible').remove();

			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['warning'] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
				}

				if (json['error']['stock']) {
					$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['stock'] + '&lt;/div&gt;');
				}

				if (json['error']['minimum']) {
					for (i in json['error']['minimum']) {
						$('#content &gt; .container-fluid').prepend('&lt;div class="alert alert-danger alert-dismissible"&gt;&lt;i class="fa fa-exclamation-circle"&gt;&lt;/i&gt; ' + json['error']['minimum'][i] + ' &lt;button type="button" class="close" data-dismiss="alert"&gt;&amp;times;&lt;/button&gt;&lt;/div&gt;');
					}
				}
			}

			var shipping = false;

			html = '';

			if (json['products'].length) {
				for (i = 0; i &lt; json['products'].length; i++) {
					product = json['products'][i];

					html += '&lt;tr&gt;';
					html += '  &lt;td class="text-left"&gt;' + product['name'] + ' ' + (!product['stock'] ? '&lt;span class="text-danger"&gt;***&lt;/span&gt;' : '') + '&lt;br /&gt;';
					html += '  &lt;input type="hidden" name="product[' + i + '][product_id]" value="' + product['product_id'] + '" /&gt;';

					if (product['option']) {
						for (j = 0; j &lt; product['option'].length; j++) {
							option = product['option'][j];

							html += '  - &lt;small&gt;' + option['name'] + ': ' + option['value'] + '&lt;/small&gt;&lt;br /&gt;';

							if (option['type'] == 'select' || option['type'] == 'radio' || option['type'] == 'image') {
								html += '&lt;input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['product_option_value_id'] + '" /&gt;';
							}

							if (option['type'] == 'checkbox') {
								html += '&lt;input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + '][]" value="' + option['product_option_value_id'] + '" /&gt;';
							}

							if (option['type'] == 'text' || option['type'] == 'textarea' || option['type'] == 'file' || option['type'] == 'date' || option['type'] == 'datetime' || option['type'] == 'time') {
								html += '&lt;input type="hidden" name="product[' + i + '][option][' + option['product_option_id'] + ']" value="' + option['value'] + '" /&gt;';
							}
						}
					}

					html += '&lt;/td&gt;';
					html += '  &lt;td class="text-left"&gt;' + product['model'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;&lt;div class="input-group btn-block" style="max-width: 200px;"&gt;&lt;input type="text" name="product[' + i + '][quantity]" value="' + product['quantity'] + '" class="form-control" /&gt;&lt;span class="input-group-btn"&gt;&lt;button type="button" data-toggle="tooltip" title="Refresh" data-loading-text="Loading..." class="btn btn-primary"&gt;&lt;i class="fa fa-refresh"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/span&gt;&lt;/div&gt;&lt;/td&gt;';
                    html += '  &lt;td class="text-right"&gt;' + product['price'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + product['total'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-center" style="width: 3px;"&gt;&lt;button type="button" value="' + product['cart_id'] + '" data-toggle="tooltip" title="Remove" data-loading-text="Loading..." class="btn btn-danger"&gt;&lt;i class="fa fa-minus-circle"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/td&gt;';
					html += '&lt;/tr&gt;';

					if (product['shipping'] != 0) {
						shipping = true;
					}
				}
			}

			if (!shipping) {
				$('select[name=\'shipping_method\'] option').removeAttr('selected');
				$('select[name=\'shipping_method\']').prop('disabled', true);
				$('#button-shipping-method').prop('disabled', true);
			} else {
				$('select[name=\'shipping_method\']').prop('disabled', false);
				$('#button-shipping-method').prop('disabled', false);
			}

			if (json['vouchers'].length) {
				for (i in json['vouchers']) {
					voucher = json['vouchers'][i];

					html += '&lt;tr&gt;';
					html += '  &lt;td class="text-left"&gt;' + voucher['description'];
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][code]" value="' + voucher['code'] + '" /&gt;';
					html += '    &lt;input type="hidden" name="voucher[' + i + '][description]" value="' + voucher['description'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][from_name]" value="' + voucher['from_name'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][from_email]" value="' + voucher['from_email'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][to_name]" value="' + voucher['to_name'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][to_email]" value="' + voucher['to_email'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][voucher_theme_id]" value="' + voucher['voucher_theme_id'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][message]" value="' + voucher['message'] + '" /&gt;';
                    html += '    &lt;input type="hidden" name="voucher[' + i + '][amount]" value="' + voucher['amount'] + '" /&gt;';
					html += '  &lt;/td&gt;';
					html += '  &lt;td class="text-left"&gt;&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;1&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + voucher['price'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + voucher['price'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-center" style="width: 3px;"&gt;&lt;button type="button" value="' + voucher['code'] + '" data-toggle="tooltip" title="Remove" data-loading-text="Loading..." class="btn btn-danger"&gt;&lt;i class="fa fa-minus-circle"&gt;&lt;/i&gt;&lt;/button&gt;&lt;/td&gt;';
					html += '&lt;/tr&gt;';
				}
			}

			if (!json['products'].length &amp;&amp; !json['vouchers'].length) {
				html += '&lt;tr&gt;';
				html += '  &lt;td colspan="6" class="text-center"&gt;No results!&lt;/td&gt;';
				html += '&lt;/tr&gt;';
			}

			$('#cart').html(html);

			// Totals
			html = '';

			if (json['products'].length) {
				for (i = 0; i &lt; json['products'].length; i++) {
					product = json['products'][i];

					html += '&lt;tr&gt;';
					html += '  &lt;td class="text-left"&gt;' + product['name'] + ' ' + (!product['stock'] ? '&lt;span class="text-danger"&gt;***&lt;/span&gt;' : '') + '&lt;br /&gt;';

					if (product['option']) {
						for (j = 0; j &lt; product['option'].length; j++) {
							option = product['option'][j];

							html += '  - &lt;small&gt;' + option['name'] + ': ' + option['value'] + '&lt;/small&gt;&lt;br /&gt;';
						}
					}

					html += '  &lt;/td&gt;';
					html += '  &lt;td class="text-left"&gt;' + product['model'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + product['quantity'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + product['price'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + product['total'] + '&lt;/td&gt;';
					html += '&lt;/tr&gt;';
				}
			}

			if (json['vouchers'].length) {
				for (i in json['vouchers']) {
					voucher = json['vouchers'][i];

					html += '&lt;tr&gt;';
					html += '  &lt;td class="text-left"&gt;' + voucher['description'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-left"&gt;&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;1&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + voucher['amount'] + '&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + voucher['amount'] + '&lt;/td&gt;';
					html += '&lt;/tr&gt;';
				}
			}

			if (json['totals'].length) {
				for (i in json['totals']) {
					total = json['totals'][i];

					html += '&lt;tr&gt;';
					html += '  &lt;td class="text-right" colspan="4"&gt;' + total['title'] + ':&lt;/td&gt;';
					html += '  &lt;td class="text-right"&gt;' + total['text'] + '&lt;/td&gt;';
					html += '&lt;/tr&gt;';
				}
			}

			if (!json['totals'].length &amp;&amp; !json['products'].length &amp;&amp; !json['vouchers'].length) {
				html += '&lt;tr&gt;';
				html += '  &lt;td colspan="5" class="text-center"&gt;No results!&lt;/td&gt;';
				html += '&lt;/tr&gt;';
			}

			$('#total').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
    </script>
</div>