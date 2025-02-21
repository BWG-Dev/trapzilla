<?php



function trapzilla_restaurant_coefficient($restaurantType, $combination)
{
	global $restaurant_coefficient;


	// Check if the restaurant type and combination exist in the array
	if (isset($restaurant_coefficient[$restaurantType][$combination])) {
		return $restaurant_coefficient[$restaurantType][$combination];
	}

	// Return null if not found
	return 0;
}

/**
 * Add custom functions here
 */
function custom_sizing_tool_shortcode() {
	ob_start();
	?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<div class="timeline-accordion">
		<div class="timeline-accordion-item"><button id="reset_btn" class="action primary large" style="float: right">Reset</button></div>
		<br>
		<br>
		<div class="timeline-accordion-item" data-step="1">
			<div class="timeline-accordion-header-1 timeline-accordion-header" data-step="1">
				<div><span class="step-number">1</span> Compartment Sinks</div>
				<div  id="step-1-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content first">
				<form id="sizing-tool-form">
					<div id="sink-fields-wrapper">
						<div class="step-description" style="flex-wrap: wrap; justify-content: center; margin-bottom: 20px;">
							<span style="min-width: 200px; flex: 1 1 50%; margin-right: 2em;">In the fields below, add the length, width, and height of each sink compartment. If all of the compartments are the same size, enter in the dimensions and select the number of compartments in your sink. Click ‘add sink with new dimensions’ if the size varies by compartment. Information for the pre-rinse sink is entered in the fixtures section.</span>
							<img style="width: 180px; height: auto; min-width: 230px; max-width: 385px; flex: 1 1 50%;" src="https://trapzilla.com/pub/media/images/Kitchen_Sink_Measurement.jpg">
						</div>
						<table class="table therm sinks" style="width:100%; margin-top: 10px;">
							<thead>
							<tr>
								<th align="center">Sink Compartments</th>
								<th>Compartment Length</th>
								<th>Compartment Width</th>
								<th>Compartment Height</th>
								<th></th>
							</tr>
							</thead>
							<tbody id="sink-rows">
							<tr class="sink-row">
								<td align="center">
									<select name="compartments_1" class="compartments">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>&nbsp;&nbsp; <strong>Compartments</strong>
								</td>
								<td>
									<input class="compartment_field clength" type="number" name="length_1" value="0" min="0">
									<span class="inches imperial" style="display: inline;">(inches)</span>
									<span class="inches metric" style="display: none;">(mm)</span>
								</td>
								<td>
									<input class="compartment_field cwidth" type="number" name="width_1" value="0" min="0">
									<span class="inches imperial" style="display: inline;">(inches)</span>
									<span class="inches metric" style="display: none;">(mm)</span>
								</td>
								<td>
									<input class="compartment_field cheight" type="number" name="height_1" value="0" min="0">
									<span class="inches imperial" style="display: inline;">(inches)</span>
									<span class="inches metric" style="display: none;">(mm)</span>
								</td>
								<td>
									<i class="fa fa-trash remove-sink" style="cursor: pointer; color: red;" data-remove-disabled="true">&times;</i>
								</td>
							</tr>
							</tbody>
						</table>
						<div class="button-toolbar add-sink" style="margin-bottom: 1em;text-align: center">
							<button class="inverse" type="button" id="add-sink-row">+ Add Sink with New Dimensions</button>
						</div>
						<div class="step-actions">
							<button class="action primary large next-step" data-step="1">NEXT</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="timeline-accordion-item" data-step="2">
			<div class="timeline-accordion-header-2 timeline-accordion-header" data-step="2">
				<div><span class="step-number">2</span> Fixtures</div>
				<div id="step-2-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content">

				<div class="step-description" style="justify-content: center;">
					<p stye="margin-bottom: 0px;">Enter in the quantity of fixtures connected to the grease interceptor. We do not need to know the dimensions for these fixtures. </p>
				</div>
				<table class="table therm fixtures">
					<thead>
					<tr>
						<th>Type of Fixture</th>
						<th># of Fixtures</th>
						<th><span class="imperial" style="display: inline;">GPM (Gallons Per Minute)</span><span class="metric" style="display: none;">l/s (Liter per Second)</span></th>
					</tr>
					</thead>
					<tbody class="fixtures-rows">
					<tr>
						<td>Floor Drains/Floor Sinks</td>
						<td>
							<button data-input="floor_drains_num" class="decrement_btn">−</button>
							<input type="number" class="fixtures_qty compartment_field" id="floor_drains_num" name="floor_drains_num" value="0" min="0" >
							<button data-input="floor_drains_num" class="increment_btn">+</button>
						</td>
						<td>
							<!--<label><span class="imperial" style="display: inline;">GPM </span><span class="metric" style="display: none;">l/s </span></label>-->
							<input value="0" readonly="" name="floor_drains_gpm" class="row-value fixtures-input">
						</td>
					</tr>
					<tr>
						<td>Mop Sink</td>
						<td>
							<button data-input="mop_sink_num" class="decrement_btn">−</button>
							<input type="number" id="mop_sink_num" class="fixtures_qty compartment_field" name="mop_sink_num" rel="mop_sink" value="0" min="0">
							<button data-input="mop_sink_num" class="increment_btn">+</button>
						</td>
						<td>
							<!--<label><span class="imperial" style="display: inline;">GPM </span><span class="metric" style="display: none;">l/s </span></label>-->
							<input value="0" readonly="" type="text" name="mop_sink_gpm" class="row-value fixtures-input">
						</td>
					</tr>
					<tr>
						<td>Hand Sink</td>
						<td>
							<button data-input="hand_sink_num" class="decrement_btn" >−</button>
							<input id="hand_sink_num" class="fixtures_qty compartment_field" type="number" name="hand_sink_num" rel="hand_sink" value="0" min="0">
							<button data-input="hand_sink_num" class="increment_btn">+</button>
						</td>
						<td>
							<!--<label><span class="imperial" style="display: inline;">GPM </span><span class="metric" style="display: none;">l/s </span></label>-->
							<input value="0" readonly="" type="text" name="hand_sink_gpm" class="row-value fixtures-input">
						</td>
					</tr>
					<tr>
						<td>Pre-Rinse Sink</td>
						<td>
							<button data-input="pre_sink_num" class="decrement_btn">−</button>
							<input type="number" class="fixtures_qty compartment_field" id="pre_sink_num" name="pre_sink_num"  rel="pre_sink" value="0" min="0">
							<button data-input="pre_sink_num" class="increment_btn">+</button>
						</td>
						<td>
							<!--<label><span class="imperial" style="display: inline;">GPM </span><span class="metric" style="display: none;">l/s </span></label>-->
							<input value="0" readonly="" type="text" name="pre_sink_gpm" class="row-value fixtures-input">
						</td>
					</tr>
					</tbody>
				</table>

				<div class="step-actions">
					<button class="action primary large next-step" data-step="2">NEXT</button>
				</div>
			</div>
		</div>
		<div class="timeline-accordion-item" data-step="3">
			<div class="timeline-accordion-header-3 timeline-accordion-header" data-step="3">
				<div><span class="step-number">3</span> Dishwasher</div>
				<div id="step-3-result" class="header-result"></div>

			</div>
			<div class="timeline-accordion-content">
				<div class="step-description" style="padding: 4em 0em 1em 0em;">
					<label>
						<span class="sub-heading-tool">Do you have a dishwasher connected to the grease interceptor?</span>
					</label>
					<select name="b_dishwasher" style="width: 10em;">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</div>

				<div class="step-description dishwasher-section" style="padding: 0em 0em 4em 0em; display: none">

					<p><span class="sub-heading-tool">What is your dishwasher’s GPM?</span><br>
						For flow rate of Dishwasher, please see dishwasher documentation. <br>
						Average dishwasher flow is 9 GPM, if you are unsure enter that.</p>
					<input style="width: 10em;height: 31px" name="dishwasher" id="dishwasher"  type="number" min="0" value="0">
				</div>

				<div class="step-actions">
					<button class="action primary large next-step" data-step="3">NEXT</button>
				</div>
			</div>
		</div>
		<div class="timeline-accordion-item" data-step="4">
			<div class="timeline-accordion-header-4 timeline-accordion-header" data-step="4">
				<div><span class="step-number">4</span> Grease Output</div>
				<div id="step-4-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content grease-output">
				<div class="step-description">
					<p>Fill out the fields below to determine the maximum amount of grease storage capacity needed for the selected pump out frequency.</p>
				</div>
				<div class="container">
					<div class="row">
						<!-- First Column: 66% width -->
						<div class="col-xs-12 col-sm-8 pr-5" style="margin-bottom: 20px;">
							<div class="row fieldset">
								<!-- Restaurant Type -->
								<div class="col-xs-12 field mb-4">
									<label class="label">Restaurant Type</label>
									<select id="restaurant_type" name="restaurant_type">
										<option value="-1">Select Restaurant Type</option>
										<option value="bakery">Bakery</option>
										<option value="bar_grill">Bar and Grill</option>
										<option value="bbq">Barbeque</option>
										<option value="breakfast_bar">Breakfast Bar - Hotel</option>
										<option value="buffet">Buffet</option>
										<option value="burger">Burger and Fries, Fast Food</option>
										<option value="cafeteria">Cafeteria</option>
										<option value="catering">Catering</option>
										<option value="chinese">Chinese</option>
										<option value="coffee">Coffee Shop</option>
										<option value="convenience">Convenience Store</option>
										<option value="deepfried">Deep Fried Chicken / Seafood</option>
										<option value="deli">Deli</option>
										<option value="family">Family Restaurant</option>
										<option value="frozen_yogurt">Frozen Yogurt</option>
										<option value="greek">Greek</option>
										<option value="grocery_bakery">Grocery Bakery</option>
										<option value="grocery_deli">Grocery Deli</option>
										<option value="grocery_meat">Grocery Meat Department</option>
										<option value="icecream">Ice Cream</option>
										<option value="indian">Indian</option>
										<option value="italian">Italian</option>
										<option value="mexican_fastfood">Mexican, Fast Food</option>
										<option value="mexican">Mexican, Full Fare</option>
										<option value="pizza">Pizza</option>
										<option value="religious">Religious Institution</option>
										<option value="sandwich">Sandwich Shop</option>
										<option value="snackbar">Snack Bar</option>
										<option value="steak">Steak and Seafood</option>
										<option value="sushi">Sushi</option>
									</select>
								</div>
								<br>
								<!-- Second Row: Fryer and Dish Type -->
								<div class="col-xs-12 col-sm-6 field">
									<label class="label">Do you have a Fryer?</label>
									<select id="tz_fryer" name="fryer">
										<option value="-1">Select Fryer</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
										<option value="1">Unsure</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-6 field">
									<label class="label">How do you serve your food?</label>
									<select id="tz-dish_type" name="dish_type">
										<option value="-1">Select Plate Type</option>
										<option value="1">Silverware and Glassware</option>
										<option value="0">Paper Plates and Plastic Utensils</option>
										<option value="1">Unsure</option>
									</select>
								</div>
								<!-- Last Row: Pump Outs -->
								<div class="col-xs-12 field mt-4">
									<label class="label">Days Between Pump Outs&nbsp;
										<span class="more-info">
                                <i class="fa fa-question-circle"></i>
                            </span>
									</label>
									<select id="pumpouts" name="pumpouts">
										<option value="30">30 Days</option>
										<option value="60">60 Days</option>
										<option selected="" value="90">90 Days</option>
									</select>
								</div>
							</div>
						</div>
						<!-- Second Column: 33% width -->
						<div class="col-xs-12 col-sm-4">
							<div class="row fieldset">
								<div class="col-xs-12 field">
									<label class="label">Customers per Day</label>
									<select name="customers_per_day" class="customers_per_day">
										<option data-min="0" data-max="30" value="15">0 to 30</option>
										<option data-min="31" data-max="60" value="45">30 to 60</option>
										<option data-min="61" data-max="120" value="90">60 to 120</option>
										<option data-min="121" data-max="200" selected="" value="160">120 to 200</option>
										<option data-min="201" data-max="300" value="250">200 to 300</option>
										<option data-min="301" data-max="500" value="400">300 to 500</option>
										<option data-min="501" data-max="1000" value="750">500 to 1000</option>
										<option data-min="1001" data-max="1000000000" value="1000">1000 +</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="step-actions">
					<button class="action primary large next-step calculate-step" data-step="4">NEXT</button>
				</div>
			</div>
		</div>
		<div class="timeline-accordion-item installation_type" data-step="5">
			<div class="timeline-accordion-header-5 timeline-accordion-header" data-step="5">
				<div><span class="step-number">5</span> Installation Type and Pipe Size</div>
				<div id="step-5-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content" >
				<!-- First Row -->
				<div class="row mb-4">
					<div class="col-md-6">
						<p>
							Please enter size of your restaurants pipes, and we will prioritize models that fit.
						</p>
					</div>
					<div class="col-md-6">
						<select id="size_metric" class="metric" name="pipe_size" style="width: 7em; display: inline;float: right">
							<option value="3">3"</option>
							<option selected value="4">4"</option>
							<option value="6">6"</option>
						</select>
						<!--<select class="imperial" name="pipe_size" style="width: 7em; display: none;float: right">
                            <option value="3">3"</option>
                            <option selected value="4">4"</option>
                            <option value="6">6"</option>
                        </select>-->
					</div>
				</div>

				<!-- Second Row -->
				<div class="row justify-content-between">
					<!-- First Column -->
					<div class="col-12 col-sm-6 col-md-5 select-box">
						<input id="underground" type="radio" name="position" value="In-Ground" checked>
						<label for="underground" class="text-center">
							<h5 class="text-center">In-ground Trapzilla</h5>
							<img src="https://trapzilla.com/pub/media/wysiwyg/Images/Trapzilla/TZ-ECA-max.jpg" alt="">
							<div class="desc-cell cell-0">
								<p>For installations where piping is buried</p>
							</div>
							<div class="desc-cell cell-1" style="height: 4rem;">
								<p>Compact &amp; durable concrete <br>grease interceptor alternative</p>
							</div>
							<div class="desc-cell cell-2">
								<p>Comes with 18” adjustable extension collar<br>(additional 29” extension collar available separately)</p>
							</div>
							<button class="action primary select inverse type-selection-btn" >SELECT</button>
						</label>
					</div>
					<!-- Second Column -->
					<div class="col-12 col-sm-6 col-md-5 select-box">
						<input id="overground" type="radio" name="position" value="Above-Ground">
						<label for="overground" class="text-center">
							<h5 class="text-center">Above-Ground Trapzilla</h5>
							<img src="https://trapzilla.com/pub/media/wysiwyg/Images/Trapzilla/TZ-SSA.jpg" alt="">
							<div class="desc-cell cell-0">
								<p>For installations where piping is exposed</p>
							</div>
							<div class="desc-cell cell-1" style="height: 4rem;">
								<p>Used in basement, parking garage, etc. installations</p>
							</div>
							<div class="desc-cell cell-2">
								<p>Comes with support stand<br>(does not add additional height to unit)</p>
							</div>
							<button class="action primary select inverse type-selection-btn">SELECT</button>
						</label>
					</div>
				</div>
				<div class="step-actions">
					<button class="action primary large next-step" data-step="5">NEXT</button>
				</div>
			</div>
		</div>
		<div class="timeline-accordion-item" data-step="6">
			<div class="timeline-accordion-header-6 timeline-accordion-header" data-step="6">
				<div><span class="step-number">6</span> Various City Requirements</div>
				<div id="step-6-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content">
				<div class="row mb-4" style="padding: 4em 0em 1em 0em;">
					<div class="col-md-8">
						<label>
							What drain time does your city require? (If you are unsure, select 2 minutes).<br>
							<small>
								Most cities have a 2-minute drain time. However, there are a few cities that require a 1-minute drain time.
							</small>
						</label>
					</div>
					<div class="col-md-4">
						<select name="drain_time" style="width: 10em;">
							<option value="2">2 Minutes</option>
							<option value="1">1 Minute</option>
						</select>
					</div>
				</div>

				<!-- Second Row -->
				<div class="row mb-4" style="padding: 0em 0em 4em 0em;">
					<div class="col-md-8">
						<label>
							Does your city require grease interceptors to have a 99% efficiency rating?<br>(If you are unsure, select no).
						</label>
					</div>
					<div class="col-md-4">
						<select name="99efficient" style="width: 10em;">
							<option value="0">No</option>
							<option value="99">Yes</option>
						</select>
					</div>
				</div>
				<div class="step-actions">
					<button class="action primary large next-step" data-step="6">NEXT</button>
				</div>
			</div>
		</div>
		<div class="timeline-accordion-item" data-step="7">
			<div class="timeline-accordion-header-7 timeline-accordion-header" data-step="7">
				<div><span class="step-number">7</span> Results</div>
				<div id="step-7-result" class="header-result"></div>
			</div>
			<div class="timeline-accordion-content">
				<table class="table therm sinks " style="width:100%; margin-top: 10px;">
					<thead>
					<tr>
						<th align="center">Total GPM</th><th>Grease Output</th><th>Model Type	</th><th>Other</th>
					</tr>
					</thead>
					<tbody >
					<tr>
						<td align="center" id="total_gpm_row"></td>
						<td id="total_grease_output"></td>
						<td id="ground_type_row"></td>
						<td id="size_row"></td>
					</tr>
					</tbody>
				</table>

				<div id="tzwrn-sizing-form" style="display: none">
					<input type="text" id="project_name" name="name" placeholder="Project name" required>

					<input type="email" id="email_pdf" name="email" placeholder="Email" required>

					<button id="send_pdf_button" type="button">Send PDF Copy</button>
				</div>
				<br>
				<p>We Recommend:</p>
				<div id="result-wrapper"></div>
				<p style="font-size: 12px">These results are solely a manufacturer’s product recommendation based on inputs entered. Consult with your city regulations for official product approval.</p>

			</div>
		</div>
	</div>


	<?php
	return ob_get_clean();
}
add_shortcode('sizing_tool', 'custom_sizing_tool_shortcode');

add_action('wp_ajax_nopriv_calculate_sizing', 'calculate_sizing_handler');
add_action('wp_ajax_calculate_sizing', 'calculate_sizing_handler');

function calculate_sizing_handler() {
	if (!isset($_POST['gpm'], $_POST['grease_volume'], $_POST['size'], $_POST['ground_type'])) {
		wp_send_json_error(['message' => 'Missing required parameters.']);
	}

	$gpm = floatval($_POST['gpm']);
	$grease_volume = floatval($_POST['grease_volume']);
	$size = sanitize_text_field($_POST['size']);
	$ground_type = sanitize_text_field($_POST['ground_type']);

	// Load the $sizing_matrix from the saved context
	global $sizing_matrix;


	// Call the get_product_details function
	// $result = get_product_details($sizing_matrix, $ground_type, $size, 151, 7201);
	$result = get_product_details($sizing_matrix, $ground_type, $size, $gpm, $grease_volume);

	$text_results = array();

	if (empty($result)) {
		wp_send_json_error(['message' => 'No products found for the given parameters.']);
	}


	// Prepare the HTML for the "Add to Cart" button
	$html = '
    <form method="post" action="' . esc_url(site_url('/cart/')) . '" style="text-align: center;">';

	foreach ($result as $item) {
		// Original SKU from the $result array
		$original_sku = $item['sku'];

		$text_results[] = $original_sku . ' (' . $item['qty'] . ')';

		// Remove postfixes using a regex pattern
		$clean_sku = preg_replace('/-SSA$|-ECA$|-SSA-6$|-ECA-6$|-6$/', '', $original_sku);

		// Get the product using the cleaned SKU
		$product = wc_get_product(wc_get_product_id_by_sku($clean_sku));

		if ($product) {
			$product_image = $product->get_image(); // Get product image HTML
			$product_name = $product->get_name(); // Get product name
			$product_id = $product->get_id(); // Get product ID
			$product_qty = $item['qty']; // Quantity to add to cart

			$html .= sprintf(
				'
                    <div style="text-align: center; margin-bottom: 20px; display: inline-block; width: 200px;">
                <div style="font-weight: bold; margin-bottom: 10px;">SKU: %s</div>
                <div class="image_qty_wrapper">
                    <div class="qty_pre">%d x</div>
                    <div class="image" style="margin-bottom: 10px;">%s</div>
                    
                </div>
                <input type="hidden" name="products[%d][id]" value="%d">
                <input type="hidden" name="products[%d][quantity]" value="%d">
            </div>',
				esc_html($original_sku),
				esc_html($product_qty),
				$product_image,

				$product_id,
				$product_id,
				$product_id,
				esc_attr($product_qty)
			);
		}
	}

	$text_results = implode(' & ', $text_results);

	$html .= '<button id="add_to_cart_all_form" type="submit" class="button" style="margin-top: 20px;">Add to Cart</button>';
	$html .= '</form>';

	echo json_encode(array('success' => true, 'html' => $html, 'result' => $text_results));
	wp_die();
}

add_action('template_redirect', 'handle_add_all_to_cart');

function handle_add_all_to_cart() {
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['products'])) {
		$products = $_POST['products'];

		foreach ($products as $product) {
			if (!empty($product['id']) && !empty($product['quantity'])) {
				$product_id = intval($product['id']);
				$quantity = intval($product['quantity']);

				if ($quantity > 0) {
					WC()->cart->add_to_cart($product_id, $quantity);
				}
			}
		}

		// Redirect to the cart page after adding products
		wp_redirect(wc_get_cart_url());
		exit;
	}
}

add_action('wp_ajax_generate_pdf', 'generate_pdf_handler');
add_action('wp_ajax_nopriv_generate_pdf', 'generate_pdf_handler');

function generate_pdf_handler() {
	if (!isset($_POST['project_name'], $_POST['email'])) {
		wp_send_json_error(['message' => 'Missing required fields']);
	}

	$compartments = json_decode(stripslashes($_POST['compartments']), true);
	$compartments_gpm = isset($_POST['compartments_gpm']) ? $_POST['compartments_gpm'] : 0;

	$floor_drains = isset($_POST['floor_drains']) ? $_POST['floor_drains'] : 0;
	$floor_drains_gpm = isset($_POST['floor_drains_gpm']) ? $_POST['floor_drains_gpm'] : 0 ;
	$mop_sink_num = isset($_POST['mop_sink_num']) ? $_POST['mop_sink_num'] : 0 ;
	$mop_sink_num_gpm = isset($_POST['mop_sink_num_gpm']) ? $_POST['mop_sink_num_gpm'] : 0;
	$hand_sink_num = isset($_POST['hand_sink_num']) ? $_POST['hand_sink_num'] : 0;
	$hand_sink_num_gpm = isset($_POST['hand_sink_num_gpm']) ? $_POST['hand_sink_num_gpm'] : 0;
	$pre_sink_num = isset($_POST['pre_sink_num']) ? $_POST['pre_sink_num'] : 0;
	$pre_sink_gpm_gpm =  isset($_POST['pre_sink_gpm_gpm']) ? $_POST['pre_sink_gpm_gpm'] : 0;
	$dishwasher =  isset($_POST['dishwasher']) ? $_POST['dishwasher'] : 0;
	$restaurant_type =  isset($_POST['restaurant_type']) ? $_POST['restaurant_type'] : 0;
	$customer_per_day =  isset($_POST['customer_per_day']) ? $_POST['customer_per_day'] : 0;
	$fryer =  isset($_POST['fryer']) ? $_POST['fryer'] : 0;
	$dish_type =  isset($_POST['dish_type']) ? $_POST['dish_type'] : 0;
	$pumpouts =  isset($_POST['pumpouts']) ? $_POST['pumpouts'] : 0;
	$grease =  isset($_POST['grease']) ? $_POST['grease'] : 0;
	$groundType =  isset($_POST['groundType']) ? $_POST['grease'] : 'Below';
	$efficient =  isset($_POST['efficient']) ? $_POST['efficient'] : 'No';
	$drain_time =  isset($_POST['efficient']) ? $_POST['efficient'] : '2 Minutes';
	$size_metric =  isset($_POST['size_metric']) ? $_POST['size_metric'] : '4';
	$result =  isset($_POST['result']) ? $_POST['result'] : '';


	$project_name = sanitize_text_field($_POST['project_name']);
	$email = sanitize_email($_POST['email']);

	if (!is_email($email)) {
		wp_send_json_error(['message' => 'Invalid email address']);
	}

	$upload_dir = wp_upload_dir();
	$pdf_dir = $upload_dir['basedir'] . '/public_pdfs/';

	// Create new PDF document
	$pdf = new TCPDF();
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('TrapZilla');
	$pdf->SetTitle('Project Report - ' . $project_name);
	$pdf->SetSubject('Project Report - ' . $project_name);
	$pdf->SetMargins(10, 10, 10);
	$pdf->AddPage();


	ob_start();
	?>
	<h1 style="text-align: center">Sizing Tool - <?php echo $project_name ?></h1>
	<br>
	<p style="font-size: 15px; line-height: 10px"><strong>Sink Compartments (Length x Width x Height)</strong></p>
	<?php
	$cont =1 ;
	foreach ($compartments as $compartment) {
		?>
		<p style="font-size: 11px;line-height: 1px"><strong>Sink #<?php echo $cont; ?>:</strong></p>
		<p style="font-size: 11px;line-height: 1px"><?php echo $compartment['compartments'] . ' Compartments ' . $compartment['length'] . '" x '  . $compartment['width'] . '" x ' . $compartment['height']; ?></p>
		<?php
		$cont++;
	}
	?>


	<br>

	<p style="font-size: 15px; line-height: 10px"><strong>Flow rate</strong></p>
	<table style="text-align: center" border="1"><thead><tr><th style="background-color: lightgray"><strong>Type of fixture</strong></th><th style="background-color: lightgray"><strong># of Fixture</strong></th><th style="background-color: lightgray"><strong>GPM</strong></th></tr></thead>
		<tbody>
		<tr><td><strong>Sink Compartments</strong></td><td><?php echo $cont; ?></td><td><?php echo intval($compartments_gpm); ?></td></tr>
		<tr><td><strong>Floor Drains/Floor Sinks</strong> </td><td><?php echo $floor_drains; ?></td><td><?php echo $floor_drains_gpm; ?></td></tr>
		<tr><td><strong>Mop Sink</strong> </td><td><?php echo $mop_sink_num; ?></td><td><?php echo $mop_sink_num_gpm; ?></td></tr>
		<tr><td><strong>Hand Sink</strong> </td><td><?php echo $hand_sink_num; ?></td><td><?php echo $hand_sink_num_gpm; ?></td></tr>
		<tr><td><strong>Pre-Rinse Sink</strong> </td><td><?php echo $pre_sink_num; ?></td><td><?php echo $pre_sink_gpm_gpm; ?></td></tr>
		<?php if(!empty($dishwasher)) : ?>
			<tr><td><strong>Dishwasher</strong> </td><td>1</td><td><?php echo $dishwasher; ?></td></tr>
		<?php endif; ?>

		</tbody>
	</table>

	<br>

	<p style="font-size: 15px; line-height: 10px"><strong>Grease Output</strong></p>
	<table style="text-align: center" border="1"><thead><tr><th style="background-color: lightgray"><strong>Field</strong></th><th style="background-color: lightgray"><strong></strong></th><th style="background-color: lightgray"><strong>Field</strong></th><th style="background-color: lightgray"><strong></strong></th></tr></thead>
		<tbody>
		<tr><td><strong>Restaurant Type</strong></td><td><?php echo $restaurant_type?></td><td><strong>Fryer</strong></td><td><?php echo $fryer?></td></tr>
		<tr><td><strong>Plates</strong></td><td><?php echo $dish_type?></td><td><strong>Pump Outs</strong></td><td><?php echo $pumpouts?></td></tr>
		<tr><td><strong>Customer per Day</strong></td><td><?php echo $customer_per_day?></td><td></td><td></td></tr>
		<tr><td style="font-size: 15px"><strong>Capacity</strong></td><td></td><td></td><td style="font-size: 15px"><strong><?php echo $grease; ?></strong></td></tr>
		</tbody>
	</table>

	<br>

	<p style="font-size: 15px; line-height: 10px"><strong>Other Requirements</strong></p>
	<table style="text-align: center" border="1"><thead><tr><th style="background-color: lightgray"><strong>Requirement</strong></th><th style="background-color: lightgray"><strong></strong></th><th style="background-color: lightgray"><strong>Requirement</strong></th><th style="background-color: lightgray"><strong></strong></th></tr></thead>
		<tbody>
		<tr><td><strong>Model Position</strong></td><td><?php echo $restaurant_type?></td><td><strong>Pipe size</strong></td><td><?php echo $size_metric; ?>"</td></tr>
		<tr><td><strong>99% Efficiency?</strong></td><td><?php echo $efficient?></td><td><strong>Drain Time</strong></td><td><?php echo $drain_time; ?></td></tr>
		</tbody>
	</table>

	<br>

	<br>

	<p style="font-size: 15px; line-height: 10px"><strong>Suggested Models:</strong></p>
	<p><?php echo $result; ?></p>
	<?php

	// Add HTML content to the PDF
	$pdf->writeHTML(ob_get_clean(), true, false, true, false, '');

	// Save PDF file
	$pdf_filename = 'report_' . time() . '.pdf';
	$pdf_path = $pdf_dir . $pdf_filename;
	$pdf_url = $upload_dir['baseurl'] . '/public_pdfs/' . $pdf_filename;
	$pdf->Output($pdf_path, 'F');

	$data = array(
		'project_name' => $project_name,
		'link' => $pdf_url,
		'pdf_path' => $pdf_path,


	);
	trap_send_pdf_copy($email, $data);

}


?>
