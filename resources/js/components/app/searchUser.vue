<template>
	<div class="searchUser">
		<!-- SEARCH SECTION  -->
		<div class="caxrd">
			<div class="form-group">
			    <label for="Search">Search</label>
			    <select class="form-control" id="search=" @change="() => {data = []; page = 1; this_page = 0;}" v-model="type">
			      <option value="name">By Name</option>
			      <option value="country">By Country</option>
			      <option value="catg">By Catgoray</option>
			    </select>
			  </div>
		</div>
		
		<div v-if="type == 'name'">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						 <input type="email" class="form-control" id="name" placeholder="Search With Name" v-model="search" @keyup="() => {data = []; page = 1; this_page = 0;}">
					</div>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-secondary btn-block" @click="install">Seach</button>
				</div>
			</div>
		</div>

		<div v-if="type == 'country'">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<select class="form-control" placeholder="country" id="country" v-model="search"  @change="() => {data = []; page = 1; this_page = 0;}">
							<option v-for="(c,index) in countrys" :value="c.text">{{c.text}}</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-secondary btn-block" @click="install">Seach</button>
					
				</div>
			</div>
		</div>

		<div v-if="type == 'catg'">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<select class="form-control" placeholder="catg" id="catg" v-model="search"  @change="() => {data = []; page = 1; this_page = 0;}">
							<option v-for="(c,index) in catg" :value="c">{{c}}</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-secondary btn-block" @click="install">Seach</button>
					
				</div>
			</div>
		</div>

		<!-- Serch Section End -->
		
		<!-- USER TABLE TO GET  -->
		<table class="table table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Phone</th>
		      <th scope="col">created at</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(d,index) in data" @click="$router.push({name:'Profile',params:{id:d.id}})">
		      <th scope="row">{{d.id}}</th>
		      <td>{{d.name}}</td>
		      <td>{{d.email}}</td>
		      <td>{{d.phone}}</td>
		      <td>{{d.created_at}}</td>
		    </tr>
		  </tbody>
		</table>
		<!-- END USER TAPLE -->

		<nav aria-label="Page navigation example" v-if="data.length > 1">
		  <ul class="pagination">
		    <li class="page-item" :class="{disabled: first}"><a class="page-link">Previous</a></li>
		    <li class="page-item" v-if="!first" @click="prev"><a class="page-link" >{{this_page - 1}}</a></li>
		    <li class="page-item active"><a class="page-link" >{{this_page}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link" >{{this_page + 1}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link">Next</a></li>
		  </ul>
		</nav>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				type:null,
				data:[],
				page:1,
				first:true,
				last_page:0,
				this_page:0,
				search:'',
				countrys:{},
				catg:['Mobile', 'Clothes','Shoes']
			}
		},
		created() {
			const vm = this;
			vm.installCountry();
		},
		methods:{
			install() {
				const vm = this;

				axios.post('/api/admin/user/'+ vm.type + '?page=' + vm.page,{search:vm.search}).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					vm.page = vm.page + 1;

					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;


				}).catch(err => {
					console.log(err)
				})
			},
			prev() {
				const vm = this;
				vm.page = vm.page - 2;
				axios.post('/api/admin/user/'+ vm.type + '?page=' + vm.page,{search:vm.search}).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					
					vm.page = vm.page + 1;
					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;



				}).catch(err => {
					console.log(err)
				})
			},
			installCatg() {
				// const vm = this;
				// axios.get('/api/admin/catg/get').then(response => {
				// 	response.data.forEach(trg => {
				// 		vm.catg.push(trg.)
				// 	});
				// }).catch(err => {
				// 	console.log(err)
				// });
			},
			installCountry() {
				const vm = this;

 const country = [ 
  {text: 'Afghanistan', code: 'AF'}, 
  {text: 'Åland Islands', code: 'AX'}, 
  {text: 'Albania', code: 'AL'}, 
  {text: 'Algeria', code: 'DZ'}, 
  {text: 'American Samoa', code: 'AS'}, 
  {text: 'AndorrA', code: 'AD'}, 
  {text: 'Angola', code: 'AO'}, 
  {text: 'Anguilla', code: 'AI'}, 
  {text: 'Antarctica', code: 'AQ'}, 
  {text: 'Antigua and Barbuda', code: 'AG'}, 
  {text: 'Argentina', code: 'AR'}, 
  {text: 'Armenia', code: 'AM'}, 
  {text: 'Aruba', code: 'AW'}, 
  {text: 'Australia', code: 'AU'}, 
  {text: 'Austria', code: 'AT'}, 
  {text: 'Azerbaijan', code: 'AZ'}, 
  {text: 'Bahamas', code: 'BS'}, 
  {text: 'Bahrain', code: 'BH'}, 
  {text: 'Bangladesh', code: 'BD'}, 
  {text: 'Barbados', code: 'BB'}, 
  {text: 'Belarus', code: 'BY'}, 
  {text: 'Belgium', code: 'BE'}, 
  {text: 'Belize', code: 'BZ'}, 
  {text: 'Benin', code: 'BJ'}, 
  {text: 'Bermuda', code: 'BM'}, 
  {text: 'Bhutan', code: 'BT'}, 
  {text: 'Bolivia', code: 'BO'}, 
  {text: 'Bosnia and Herzegovina', code: 'BA'}, 
  {text: 'Botswana', code: 'BW'}, 
  {text: 'Bouvet Island', code: 'BV'}, 
  {text: 'Brazil', code: 'BR'}, 
  {text: 'British Indian Ocean Territory', code: 'IO'}, 
  {text: 'Brunei Darussalam', code: 'BN'}, 
  {text: 'Bulgaria', code: 'BG'}, 
  {text: 'Burkina Faso', code: 'BF'}, 
  {text: 'Burundi', code: 'BI'}, 
  {text: 'Cambodia', code: 'KH'}, 
  {text: 'Cameroon', code: 'CM'}, 
  {text: 'Canada', code: 'CA'}, 
  {text: 'Cape Verde', code: 'CV'}, 
  {text: 'Cayman Islands', code: 'KY'}, 
  {text: 'Central African Republic', code: 'CF'}, 
  {text: 'Chad', code: 'TD'}, 
  {text: 'Chile', code: 'CL'}, 
  {text: 'China', code: 'CN'}, 
  {text: 'Christmas Island', code: 'CX'}, 
  {text: 'Cocos (Keeling) Islands', code: 'CC'}, 
  {text: 'Colombia', code: 'CO'}, 
  {text: 'Comoros', code: 'KM'}, 
  {text: 'Congo', code: 'CG'}, 
  {text: 'Congo, The Democratic Republic of the', code: 'CD'}, 
  {text: 'Cook Islands', code: 'CK'}, 
  {text: 'Costa Rica', code: 'CR'}, 
  {text: 'Cote D\'Ivoire', code: 'CI'}, 
  {text: 'Croatia', code: 'HR'}, 
  {text: 'Cuba', code: 'CU'}, 
  {text: 'Cyprus', code: 'CY'}, 
  {text: 'Czech Republic', code: 'CZ'}, 
  {text: 'Denmark', code: 'DK'}, 
  {text: 'Djibouti', code: 'DJ'}, 
  {text: 'Dominica', code: 'DM'}, 
  {text: 'Dominican Republic', code: 'DO'}, 
  {text: 'Ecuador', code: 'EC'}, 
  {text: 'Egypt', code: 'EG'}, 
  {text: 'El Salvador', code: 'SV'}, 
  {text: 'Equatorial Guinea', code: 'GQ'}, 
  {text: 'Eritrea', code: 'ER'}, 
  {text: 'Estonia', code: 'EE'}, 
  {text: 'Ethiopia', code: 'ET'}, 
  {text: 'Falkland Islands (Malvinas)', code: 'FK'}, 
  {text: 'Faroe Islands', code: 'FO'}, 
  {text: 'Fiji', code: 'FJ'}, 
  {text: 'Finland', code: 'FI'}, 
  {text: 'France', code: 'FR'}, 
  {text: 'French Guiana', code: 'GF'}, 
  {text: 'French Polynesia', code: 'PF'}, 
  {text: 'French Southern Territories', code: 'TF'}, 
  {text: 'Gabon', code: 'GA'}, 
  {text: 'Gambia', code: 'GM'}, 
  {text: 'Georgia', code: 'GE'}, 
  {text: 'Germany', code: 'DE'}, 
  {text: 'Ghana', code: 'GH'}, 
  {text: 'Gibraltar', code: 'GI'}, 
  {text: 'Greece', code: 'GR'}, 
  {text: 'Greenland', code: 'GL'}, 
  {text: 'Grenada', code: 'GD'}, 
  {text: 'Guadeloupe', code: 'GP'}, 
  {text: 'Guam', code: 'GU'}, 
  {text: 'Guatemala', code: 'GT'}, 
  {text: 'Guernsey', code: 'GG'}, 
  {text: 'Guinea', code: 'GN'}, 
  {text: 'Guinea-Bissau', code: 'GW'}, 
  {text: 'Guyana', code: 'GY'}, 
  {text: 'Haiti', code: 'HT'}, 
  {text: 'Heard Island and Mcdonald Islands', code: 'HM'}, 
  {text: 'Holy See (Vatican City State)', code: 'VA'}, 
  {text: 'Honduras', code: 'HN'}, 
  {text: 'Hong Kong', code: 'HK'}, 
  {text: 'Hungary', code: 'HU'}, 
  {text: 'Iceland', code: 'IS'}, 
  {text: 'India', code: 'IN'}, 
  {text: 'Indonesia', code: 'ID'}, 
  {text: 'Iran, Islamic Republic Of', code: 'IR'}, 
  {text: 'Iraq', code: 'IQ'}, 
  {text: 'Ireland', code: 'IE'}, 
  {text: 'Isle of Man', code: 'IM'}, 
  {text: 'Israel', code: 'IL'}, 
  {text: 'Italy', code: 'IT'}, 
  {text: 'Jamaica', code: 'JM'}, 
  {text: 'Japan', code: 'JP'}, 
  {text: 'Jersey', code: 'JE'}, 
  {text: 'Jordan', code: 'JO'}, 
  {text: 'Kazakhstan', code: 'KZ'}, 
  {text: 'Kenya', code: 'KE'}, 
  {text: 'Kiribati', code: 'KI'}, 
  {text: 'Korea, Democratic People\'S Republic of', code: 'KP'}, 
  {text: 'Korea, Republic of', code: 'KR'}, 
  {text: 'Kuwait', code: 'KW'}, 
  {text: 'Kyrgyzstan', code: 'KG'}, 
  {text: 'Lao People\'S Democratic Republic', code: 'LA'}, 
  {text: 'Latvia', code: 'LV'}, 
  {text: 'Lebanon', code: 'LB'}, 
  {text: 'Lesotho', code: 'LS'}, 
  {text: 'Liberia', code: 'LR'}, 
  {text: 'Libyan Arab Jamahiriya', code: 'LY'}, 
  {text: 'Liechtenstein', code: 'LI'}, 
  {text: 'Lithuania', code: 'LT'}, 
  {text: 'Luxembourg', code: 'LU'}, 
  {text: 'Macao', code: 'MO'}, 
  {text: 'Macedonia, The Former Yugoslav Republic of', code: 'MK'}, 
  {text: 'Madagascar', code: 'MG'}, 
  {text: 'Malawi', code: 'MW'}, 
  {text: 'Malaysia', code: 'MY'}, 
  {text: 'Maldives', code: 'MV'}, 
  {text: 'Mali', code: 'ML'}, 
  {text: 'Malta', code: 'MT'}, 
  {text: 'Marshall Islands', code: 'MH'}, 
  {text: 'Martinique', code: 'MQ'}, 
  {text: 'Mauritania', code: 'MR'}, 
  {text: 'Mauritius', code: 'MU'}, 
  {text: 'Mayotte', code: 'YT'}, 
  {text: 'Mexico', code: 'MX'}, 
  {text: 'Micronesia', code: 'FM'}, 
  {text: 'Moldova, Republic of', code: 'MD'}, 
  {text: 'Monaco', code: 'MC'}, 
  {text: 'Mongolia', code: 'MN'}, 
  {text: 'Montserrat', code: 'MS'}, 
  {text: 'Morocco', code: 'MA'}, 
  {text: 'Mozambique', code: 'MZ'}, 
  {text: 'Myanmar', code: 'MM'}, 
  {text: 'Namibia', code: 'NA'}, 
  {text: 'Nauru', code: 'NR'}, 
  {text: 'Nepal', code: 'NP'}, 
  {text: 'Netherlands', code: 'NL'}, 
  {text: 'Netherlands Antilles', code: 'AN'}, 
  {text: 'New Caledonia', code: 'NC'}, 
  {text: 'New Zealand', code: 'NZ'}, 
  {text: 'Nicaragua', code: 'NI'}, 
  {text: 'Niger', code: 'NE'}, 
  {text: 'Nigeria', code: 'NG'}, 
  {text: 'Niue', code: 'NU'}, 
  {text: 'Norfolk Island', code: 'NF'}, 
  {text: 'Northern Mariana Islands', code: 'MP'}, 
  {text: 'Norway', code: 'NO'}, 
  {text: 'Oman', code: 'OM'}, 
  {text: 'Pakistan', code: 'PK'}, 
  {text: 'Palau', code: 'PW'}, 
  {text: 'Palestine', code: 'PS'}, 
  {text: 'Panama', code: 'PA'}, 
  {text: 'Papua New Guinea', code: 'PG'}, 
  {text: 'Paraguay', code: 'PY'}, 
  {text: 'Peru', code: 'PE'}, 
  {text: 'Philippines', code: 'PH'}, 
  {text: 'Pitcairn', code: 'PN'}, 
  {text: 'Poland', code: 'PL'}, 
  {text: 'Portugal', code: 'PT'}, 
  {text: 'Puerto Rico', code: 'PR'}, 
  {text: 'Qatar', code: 'QA'}, 
  {text: 'Reunion', code: 'RE'}, 
  {text: 'Romania', code: 'RO'}, 
  {text: 'Russian Federation', code: 'RU'}, 
  {text: 'RWANDA', code: 'RW'}, 
  {text: 'Saint Helena', code: 'SH'}, 
  {text: 'Saint Kitts and Nevis', code: 'KN'}, 
  {text: 'Saint Lucia', code: 'LC'}, 
  {text: 'Saint n', code: 'PM'}, 
  {text: 'Saint ', code: 'VC'}, 
  {text: 'Samoa', code: 'WS'}, 
  {text: 'San Marino', code: 'SM'}, 
  {text: 'Sao Tome and Principe', code: 'ST'}, 
  {text: 'Saudi Arabia', code: 'SA'}, 
  {text: 'Senegal', code: 'SN'}, 
  {text: 'Serbia', code: 'CS'}, 
  {text: 'Seychelles', code: 'SC'}, 
  {text: 'Sierra Leone', code: 'SL'}, 
  {text: 'Singapore', code: 'SG'}, 
  {text: 'Slovakia', code: 'SK'}, 
  {text: 'Slovenia', code: 'SI'}, 
  {text: 'Solomon Islands', code: 'SB'}, 
  {text: 'Somalia', code: 'SO'}, 
  {text: 'South Africa', code: 'ZA'}, 
  {text: 'South Georgia', code: 'GS'}, 
  {text: 'Spain', code: 'ES'}, 
  {text: 'Sri Lanka', code: 'LK'}, 
  {text: 'Sudan', code: 'SD'}, 
  {text: 'Suritext', code: 'SR'}, 
  {text: 'Svalbard and Jan Mayen', code: 'SJ'}, 
  {text: 'Swaziland', code: 'SZ'}, 
  {text: 'Sweden', code: 'SE'}, 
  {text: 'Switzerland', code: 'CH'}, 
  {text: 'Syria', code: 'SY'}, 
  {text: 'Taiwan, Province of China', code: 'TW'}, 
  {text: 'Tajikistan', code: 'TJ'}, 
  {text: 'Tanzania,', code: 'TZ'}, 
  {text: 'Thailand', code: 'TH'}, 
  {text: 'Timor-Leste', code: 'TL'}, 
  {text: 'Togo', code: 'TG'}, 
  {text: 'Tokelau', code: 'TK'}, 
  {text: 'Tonga', code: 'TO'}, 
  {text: 'Trinidad and Tobago', code: 'TT'}, 
  {text: 'Tunisia', code: 'TN'}, 
  {text: 'Turkey', code: 'TR'}, 
  {text: 'Turkmenistan', code: 'TM'}, 
  {text: 'Turks ', code: 'TC'}, 
  {text: 'Tuvalu', code: 'TV'}, 
  {text: 'Uganda', code: 'UG'}, 
  {text: 'Ukraine', code: 'UA'}, 
  {text: 'United Arab Emirates', code: 'AE'}, 
  {text: 'United Kingdom', code: 'GB'}, 
  {text: 'United States', code: 'US'}, 
  {text: 'United States Minor', code: 'UM'}, 
  {text: 'Uruguay', code: 'UY'}, 
  {text: 'Uzbekistan', code: 'UZ'}, 
  {text: 'Vanuatu', code: 'VU'}, 
  {text: 'Venezuela', code: 'VE'}, 
  {text: 'Viet Nam', code: 'VN'}, 
  {text: 'Virgin Islands, British', code: 'VG'}, 
  {text: 'Virgin Islands, U.S.', code: 'VI'}, 
  {text: 'Wallis and Futuna', code: 'WF'}, 
  {text: 'Western Sahara', code: 'EH'}, 
  {text: 'Yemen', code: 'YE'}, 
  {text: 'Zambia', code: 'ZM'}, 
  {text: 'Zimbabwe', code: 'ZW'} 
]
vm.countrys = country;
			}
		}
	}
</script>
<style>
	
</style>