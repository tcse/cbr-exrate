<table>
	<tr>
		<td>
			{0-date=d F Y}
		</td>
	</tr>
</table>

<table class="table">
	<tr>
		<td>USD ЦБ: <b>{dollar}</b> <i class="fa fa-rub"></i> за 1 доллар США</td>
    </tr>
    <tr>
		<td>EUR ЦБ: <b>{euro}</b> <i class="fa fa-rub"></i> за 1 Евро</td>
	</tr>
	<tr>
		<td>BYN ЦБ: <b>{byn}</b> <i class="fa fa-rub"></i> за 1 Беларуский рубль</td>
	</tr>
	<tr>
		<td>KZT ЦБ: <b>{kzt}</b> <i class="fa fa-rub"></i> за 100 Казахстанских тенге</td>
	</tr>
	<tr>
		<td>UAH ЦБ: <b>{uah}</b> <i class="fa fa-rub"></i> за 10 Украинских гривен</td>
	</tr>
</table>


[tommorow]
<table>
	<tr>
		<td>
			{1-date=d F Y}
		</td>
	</tr>
</table>

<table class="table">
	<tr>
		<td>USD ЦБ: <b>{dollar-tommrow}</b> <i class="fa fa-rub"></i></td>
	</tr>
    <tr>
		<td>EUR ЦБ: <b>{euro-tomorrow}</b> <i class="fa fa-rub"></i></td>
	</tr>
</table>
[/tommorow]


{* добавление скрипта пересчета курсов валют *}
<script>
	var currencyConverter = {
		getConvertedPrice: function(price) {
			return {
				rub: currencyConverter.formatPrice(price * {euro})
			};
		},
		/**
		 * Форматирование цены с разделением разрядов
		 *
		 * @param      {number}  price   Цена
		 * @return     {tring}   Отформатированная цена
		 */
		formatPrice: function (price) {
			var decimal = 2;     // Копейки (сколько цифр после запятой нужно на выходе) 
			var separator = ' '; // Разделитель разрядов
			var decpoint = '.';  // Зазделитель копеек

			var formattedPrice = parseFloat(price)
			var powPrice = Math.pow(10, decimal);
			formattedPrice = Math.round(formattedPrice * powPrice) / powPrice;
			var separatedPrice = Number(formattedPrice).toFixed(decimal).toString().split('.');
			var priceWSpaces = separatedPrice[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);
			formattedPrice = (separatedPrice[1] ? priceWSpaces + decpoint + separatedPrice[1] : priceWSpaces);

			return formattedPrice;
		}
	}

</script>