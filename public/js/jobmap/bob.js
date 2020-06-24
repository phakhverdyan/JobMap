/**
* bootstrap-formhelpers.js v2.3.0 by @vincentlamanna
* Copyright 2013 Vincent Lamanna
* http://www.apache.org/licenses/LICENSE-2.0
*/
if (!jQuery) { throw new Error("Bootstrap Form Helpers requires jQuery"); }

/* ==========================================================
 * bootstrap-formhelpers-countries.en_US.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
 
var BFHCountriesList = {
  'AF': '+93 <span>Afghanistan</span>',
  'AL': '+355 <span>Albania</span>',
  'DZ': '+213 <span>Algeria</span>',
  'AS': '+1 <span>American Samoa</span>',
  'AD': '+376 <span>Andorra</span>',
  'AO': '+244 <span>Angola</span>',
  'AI': '+1 <span>Anguilla</span>',
  'AQ': '+672 <span>Antarctica</span>',
  'AG': '+1 <span>Antigua and Barbuda</span>',
  'AR': '+54 <span>Argentina</span>',
  'AM': '+374 <span>Armenia</span>',
  'AW': '+297 <span>Aruba</span>',
  'AU': '+61 <span>Australia</span>',
  'AT': '+43 <span>Austria</span>',
  'AZ': '+994 <span>Azerbaijan</span>',
  'BH': '+973 <span>Bahrain</span>',
  'BD': '+880 <span>Bangladesh</span>',
  'BB': '+1 <span>Barbados</span>',
  'BY': '+375 <span>Belarus</span>',
  'BE': '+32 <span>Belgium</span>',
  'BZ': '+501 <span>Belize</span>',
  'BJ': '+229 <span>Benin</span>',
  'BM': '+1 <span>Bermuda</span>',
  'BT': '+975 <span>Bhutan</span>',
  'BO': '+591 <span>Bolivia</span>',
  'BA': '+387 <span>Bosnia and Herzegovina</span>',
  'BW': '+267 <span>Botswana</span>',
  'BV': '+0 <span>Bouvet Island</span>',
  'BR': '+55 <span>Brazil</span>',
  'IO': '+0 <span>British Indian Ocean Territory</span>',
  'VG': '+1 <span>British Virgin Islands</span>',
  'BN': '+673 <span>Brunei</span>',
  'BG': '+359 <span>Bulgaria</span>',
  'BF': '+226 <span>Burkina Faso</span>',
  'BI': '+257 <span>Burundi</span>',
  'CI': '+225 <span>Côte d\'Ivoire</span>',
  'KH': '+855 <span>Cambodia</span>',
  'CM': '+237 <span>Cameroon</span>',
  'CA': '+1 <span>Canada</span>',
  'CV': '+238 <span>Cape Verde</span>',
  'KY': '+1 <span>Cayman Islands</span>',
  'CF': '+236 <span>Central African Republic</span>',
  'TD': '+235 <span>Chad</span>',
  'CL': '+56 <span>Chile</span>',
  'CN': '+86 <span>China</span>',
  'CX': '+61 <span>Christmas Island</span>',
  'CC': '+61 <span>Cocos (Keeling) Islands</span>',
  'CO': '+57 <span>Colombia</span>',
  'KM': '+269 <span>Comoros</span>',
  'CG': '+242 <span>Congo</span>',
  'CK': '+682 <span>Cook Islands</span>',
  'CR': '+506 <span>Costa Rica</span>',
  'HR': '+385 <span>Croatia</span>',
  'CU': '+53 <span>Cuba</span>',
  'CY': '+357 <span>Cyprus</span>',
  'CZ': '+420 <span>Czech Republic</span>',
  'CD': '+243 <span>Democratic Republic of the Congo</span>',
  'DK': '+45 <span>Denmark</span>',
  'DJ': '+253 <span>Djibouti</span>',
  'DM': '+1 <span>Dominica</span>',
  'DO': '+1 <span>Dominican Republic</span>',
  'TP': '+670 <span>East Timor</span>',
  'EC': '+593 <span>Ecuador</span>',
  'EG': '+20 <span>Egypt</span>',
  'SV': '+503 <span>El Salvador</span>',
  'GQ': '+240 <span>Equatorial Guinea</span>',
  'ER': '+291 <span>Eritrea</span>',
  'EE': '+372 <span>Estonia</span>',
  'ET': '+251 <span>Ethiopia</span>',
  'FO': '+298 <span>Faeroe Islands</span>',
  'FK': '+500 <span>Falkland Islands</span>',
  'FJ': '+679 <span>Fiji</span>',
  'FI': '+358 <span>Finland</span>',
  'MK': '+389 <span>Former Yugoslav Republic of Macedonia</span>',
  'FR': '+33 <span>France</span>',
  'FX': ' <span>France, Metropolitan</span>',
  'GF': '+594 <span>French Guiana</span>',
  'PF': '+689 <span>French Polynesia</span>',
  'TF': '+262 <span>French Southern Territories</span>',
  'GA': '+241 <span>Gabon</span>',
  'GE': '+995 <span>Georgia</span>',
  'DE': '+49 <span>Germany</span>',
  'GH': '+233 <span>Ghana</span>',
  'GI': '+350 <span>Gibraltar</span>',
  'GR': '+30 <span>Greece</span>',
  'GL': '+299 <span>Greenland</span>',
  'GD': '+1 <span>Grenada</span>',
  'GP': '+590 <span>Guadeloupe</span>',
  'GU': '+1 <span>Guam</span>',
  'GT': '+502 <span>Guatemala</span>',
  'GN': '+224 <span>Guinea</span>',
  'GW': '+245 <span>Guinea-Bissau</span>',
  'GY': '+592 <span>Guyana</span>',
  'HT': '+509 <span>Haiti</span>',
  'HM': '+0 <span>Heard and Mc Donald Islands</span>',
  'HN': '+504 <span>Honduras</span>',
  'HK': '+852 <span>Hong Kong</span>',
  'HU': '+36 <span>Hungary</span>',
  'IS': '+354 <span>Iceland</span>',
  'IN': '+91 <span>India</span>',
  'ID': '+62 <span>Indonesia</span>',
  'IR': '+98 <span>Iran</span>',
  'IQ': '+964 <span>Iraq</span>',
  'IE': '+353 <span>Ireland</span>',
  'IL': '+972 <span>Israel</span>',
  'IT': '+39 <span>Italy</span>',
  'JM': '+1 <span>Jamaica</span>',
  'JP': '+81 <span>Japan</span>',
  'JO': '+962 <span>Jordan</span>',
  'KZ': '+7 <span>Kazakhstan</span>',
  'KE': '+254 <span>Kenya</span>',
  'KI': '+686 <span>Kiribati</span>',
  'KW': '+965 <span>Kuwait</span>',
  'KG': '+996 <span>Kyrgyzstan</span>',
  'LA': '+856 <span>Laos</span>',
  'LV': '+371 <span>Latvia</span>',
  'LB': '+961 <span>Lebanon</span>',
  'LS': '+266 <span>Lesotho</span>',
  'LR': '+231 <span>Liberia</span>',
  'LY': '+218 <span>Libya</span>',
  'LI': '+423 <span>Liechtenstein</span>',
  'LT': '+370 <span>Lithuania</span>',
  'LU': '+352 <span>Luxembourg</span>',
  'MO': '+853 <span>Macau</span>',
  'MG': '+261 <span>Madagascar</span>',
  'MW': '+265 <span>Malawi</span>',
  'MY': '+60 <span>Malaysia</span>',
  'MV': '+960 <span>Maldives</span>',
  'ML': '+223 <span>Mali</span>',
  'MT': '+356 <span>Malta</span>',
  'MH': '+692 <span>Marshall Islands</span>',
  'MQ': '+596 <span>Martinique</span>',
  'MR': '+222 <span>Mauritania</span>',
  'MU': '+230 <span>Mauritius</span>',
  'YT': '+262 <span>Mayotte</span>',
  'MX': '+52 <span>Mexico</span>',
  'FM': '+691 <span>Micronesia</span>',
  'MD': '+373 <span>Moldova</span>',
  'MC': '+377 <span>Monaco</span>',
  'MN': '+976 <span>Mongolia</span>',
  'ME': '+ <span>Montenegro</span>',
  'MS': '+1 <span>Montserrat</span>',
  'MA': '+212 Morocco',
  'MZ': '+258 Mozambique',
  'MM': '+95 <span>Myanmar</span>',
  'NA': '+264 <span>Namibia</span>',
  'NR': '+674 <span>Nauru</span>',
  'NP': '+977 <span>Nepal</span>',
  'NL': '+31 <span>Netherlands</span>',
  'AN': '+599 <span>Netherlands Antilles</span>',
  'NC': '+687 <span>New Caledonia</span>',
  'NZ': '+64 <span>New Zealand</span>',
  'NI': '+505 <span>Nicaragua</span>',
  'NE': '+227 <span>Niger</span>',
  'NG': '+234 <span>Nigeria</span>',
  'NU': '+683 <span>Niue</span>',
  'NF': '+672 <span>Norfolk Island</span>',
  'KP': '+ North Korea',
  'MP': '+850 <span>Northern Marianas</span>',
  'NO': '+1 <span>Norway</span>',
  'OM': '+47 <span>Oman</span>',
  'PK': '+968 <span>Pakistan</span>',
  'PW': '+92 <span>Palau</span>',
  'PS': '+680 <span>Palestine</span>',
  'PA': '+507 <span>Panama</span>',
  'PG': '+675 <span>Papua New Guinea</span>',
  'PY': '+595 <span>Paraguay</span>',
  'PE': '+51 <span>Peru</span>',
  'PH': '+63 <span>Philippines</span>',
  'PN': '+870 <span>Pitcairn Islands</span>',
  'PL': '+48 <span>Poland</span>',
  'PT': '+351 <span>Portugal</span>',
  'PR': '+1 <span>Puerto Rico</span>',
  'QA': '+974 <span>Qatar</span>',
  'RE': '+262 <span>Reunion</span>',
  'RO': '+40 <span>Romania</span>',
  'RU': '+7 <span>Russia</span>',
  'RW': '+250 <span>Rwanda</span>',
  'ST': '+239 <span>São Tomé and Príncipe</span>',
  'SH': '+290 <span>Saint Helena</span>',
  'PM': 'St. Pierre and Miquelon</span>',
  'KN': '+1 <span>Saint Kitts and Nevis</span>',
  'LC': '+1 <span>Saint Lucia</span>',
  'VC': '+508 <span>Saint Vincent and the Grenadines</span>',
  'WS': '+1 <span>Samoa</span>',
  'SM': '+685 <span>San Marino</span>',
  'SA': '+378 <span>Saudi Arabia</span>',
  'SN': '+966 <span>Senegal</span>',
  'RS': '+221 <span>Serbia</span>',
  'SC': '+248 <span>Seychelles</span>',
  'SL': '+232 <span>Sierra Leone</span>',
  'SG': '+65 <span>Singapore</span>',
  'SK': '+421 <span>Slovakia</span>',
  'SI': '+386 <span>Slovenia</span>',
  'SB': '+677 <span>Solomon Islands</span>',
  'SO': '+252 <span>Somalia</span>',
  'ZA': '+27 <span>South Africa</span>',
  'GS': '+0 <span>South Georgia and the South Sandwich Islands</span>',
  'KR': '+82 <span>South Korea</span>',
  'ES': '+34 <span>Spain</span>',
  'LK': '+94 <span>Sri Lanka</span>',
  'SD': '+249 <span>Sudan</span>',
  'SR': '+597 <span>Suriname</span>',
  'SJ': '+0 <span>Svalbard and Jan Mayen Islands</span>',
  'SZ': '+268 <span>Swaziland</span>',
  'SE': '+46 <span>Sweden</span>',
  'CH': '+41 <span>Switzerland</span>',
  'SY': '+963 <span>Syria</span>',
  'TW': '+886 <span>Taiwan</span>',
  'TJ': '+992 <span>Tajikistan</span>',
  'TZ': '+255 <span>Tanzania</span>',
  'TH': '+66 <span>Thailand</span>',
  'BS': '+1 <span>The Bahamas</span>',
  'GM': '+220 <span>The Gambia</span>',
  'TG': '+228 <span>Togo</span>',
  'TK': '+690 <span>Tokelau</span>',
  'TO': '+676 <span>Tonga</span>',
  'TT': '+1 <span>Trinidad and Tobago</span>',
  'TN': '+216 <span>Tunisia</span>',
  'TR': '+90 <span>Turkey</span>',
  'TM': '+993 <span>Turkmenistan</span>',
  'TC': '+1 <span>Turks and Caicos Islands</span>',
  'TV': '+688 <span>Tuvalu</span>',
  'VI': '+1 <span>US Virgin Islands</span>',
  'UG': '+256 <span>Uganda</span>',
  'UA': '+380 <span>Ukraine</span>',
  'AE': '+971 <span>United Arab Emirates</span>',
  'GB': '+44 <span>United Kingdom</span>',
  'US': '+1 <span>United States</span>',
  'UM': '+0 <span>United States Minor Outlying Islands</span>',
  'UY': '+598 <span>Uruguay</span>',
  'UZ': '+998 <span>Uzbekistan</span>',
  'VU': '+678 <span>Vanuatu</span>',
  'VA': '+39 <span>Vatican City</span>',
  'VE': '+58 <span>Venezuela</span>',
  'VN': '+84 <span>Vietnam</span>',
  'WF': '+681 <span>Wallis and Futuna Islands</span>',
  'EH': '+0 <span>Western Sahara</span>',
  'YE': '+967 <span>Yemen</span>',
  'ZM': '+260 <span>Zambia</span>',
  'ZW': '+263 <span>Zimbabwe</span>'


};


/* ==========================================================
 * bootstrap-formhelpers-phone.en_US.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file edcept in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either edpress or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
 
var BFHPhoneFormatList = {
  'AF': '+93 0dd ddd dddd',
  'AL': '+355 0dd ddd ddd',
  'DZ': '+213 0ddd dd dd dd',
  'AS': '+1 (ddd) ddd-dddd',
  'AD': '+376 ddddddddd',
  'AO': '+244 ddd ddd ddd',
  'AI': '+1 (ddd) ddd-dddd',
  'AQ': '+672 ddddddddd',
  'AG': '+1 (ddd) ddd-dddd',
  'AR': '+54 ddddddddd',
  'AM': '+374 0dd dddddd',
  'AW': '+297 ddd dddd',
  'AU': '+61 ddd ddd ddd',
  'AT': '+43 0dddd ddddddddd',
  'AZ': '+994 ddddddddd',
  'BH': '+973 ddddddddd',
  'BD': '+880 ddddddddd',
  'BB': '+1 ddddddddd',
  'BY': '+375 ddddddddd',
  'BE': '+32 ddddddddd',
  'BZ': '+501 ddddddddd',
  'BJ': '+229 ddddddddd',
  'BM': '+1 (ddd) ddd-dddd',
  'BT': '+975 ddddddddd',
  'BO': '+591 ddddddddd',
  'BA': '+387 ddddddddd',
  'BW': '+267 ddddddddd',
  'BV': '+0 ddddddddd',
  'BR': '+55 ddddddddd',
  'IO': '+0 ddddddddd',
  'VG': '+1 (ddd) ddd-dddd',
  'BN': '+673 ddddddddd',
  'BG': '+359 ddddddddd',
  'BF': '+226 ddddddddd',
  'BI': '+257 ddddddddd',
  'CI': '+225 ddddddddd',
  'KH': '+855 ddddddddd',
  'CM': '+237 ddddddddd',
  'CA': '+1 (ddd) ddd-dddd',
  'CV': '+238 ddddddddd',
  'KY': '+1 (ddd) ddd-dddd',
  'CF': '+236 ddddddddd',
  'TD': '+235 ddddddddd',
  'CL': '+56 ddddddddd',
  'CN': '+86 ddddddddd',
  'CX': '+61 ddddddddd',
  'CC': '+61 ddddddddd',
  'CO': '+57 ddddddddd',
  'KM': '+269 ddddddddd',
  'CG': '+242 ddddddddd',
  'CK': '+682 ddddddddd',
  'CR': '+506 ddddddddd',
  'HR': '+385 ddddddddd',
  'CU': '+53 ddddddddd',
  'CY': '+357 ddddddddd',
  'CZ': '+420 ddddddddd',
  'CD': '+243 ddddddddd',
  'DK': '+45 ddddddddd',
  'DJ': '+253 ddddddddd',
  'DM': '+1 (ddd) ddd-dddd',
  'DO': '+1 (ddd) ddd-dddd',
  'TL': '+670 ddddddddd',
  'EC': '+593 ddddddddd',
  'EG': '+20 ddddddddd',
  'SV': '+503 ddddddddd',
  'GQ': '+240 ddddddddd',
  'ER': '+291 ddddddddd',
  'EE': '+372 ddddddddd',
  'ET': '+251 ddddddddd',
  'FO': '+298 ddddddddd',
  'FK': '+500 ddddddddd',
  'FJ': '+679 ddddddddd',
  'FI': '+358 ddddddddd',
  'MK': '+389 ddddddddd',
  'FR': '+33 d dd dd dd dd',
  'GF': '+594 ddddddddd',
  'PF': '+689 ddddddddd',
  'TF': '+262 ddddddddd',
  'GA': '+241 ddddddddd',
  'GE': '+995 ddddddddd',
  'DE': '+49 ddddddddd',
  'GH': '+233 ddddddddd',
  'GI': '+350 ddddddddd',
  'GR': '+30 ddddddddd',
  'GL': '+299 ddddddddd',
  'GD': '+1 (ddd) ddd-dddd',
  'GP': '+590 ddddddddd',
  'GU': '+1 (ddd) ddd-dddd',
  'GT': '+502 ddddddddd',
  'GN': '+224 ddddddddd',
  'GW': '+245 ddddddddd',
  'GY': '+592 ddddddddd',
  'HT': '+509 ddddddddd',
  'HM': '+0 ddddddddd',
  'HN': '+504 ddddddddd',
  'HK': '+852 ddddddddd',
  'HU': '+36 ddddddddd',
  'IS': '+354 ddddddddd',
  'IN': '+91 ddddddddd',
  'ID': '+62 ddddddddd',
  'IR': '+98 ddddddddd',
  'IQ': '+964 ddddddddd',
  'IE': '+353 ddddddddd',
  'IL': '+972 ddddddddd',
  'IT': '+39 ddddddddd',
  'JM': '+1 (ddd) ddd-dddd',
  'JP': '+81 ddddddddd',
  'JO': '+962 ddddddddd',
  'KZ': '+7 ddddddddd',
  'KE': '+254 ddddddddd',
  'KI': '+686 ddddddddd',
  'KW': '+965 ddddddddd',
  'KG': '+996 ddddddddd',
  'LA': '+856 ddddddddd',
  'LV': '+371 ddddddddd',
  'LB': '+961 ddddddddd',
  'LS': '+266 ddddddddd',
  'LR': '+231 ddddddddd',
  'LY': '+218 ddddddddd',
  'LI': '+423 ddddddddd',
  'LT': '+370 ddddddddd',
  'LU': '+352 ddddddddd',
  'MO': '+853 ddddddddd',
  'MG': '+261 ddddddddd',
  'MW': '+265 ddddddddd',
  'MY': '+60 ddddddddd',
  'MV': '+960 ddddddddd',
  'ML': '+223 ddddddddd',
  'MT': '+356 ddddddddd',
  'MH': '+692 ddddddddd',
  'MQ': '+596 ddddddddd',
  'MR': '+222 ddddddddd',
  'MU': '+230 ddddddddd',
  'YT': '+262 ddddddddd',
  'MX': '+52 ddddddddd',
  'FM': '+691 ddddddddd',
  'MD': '+373 ddddddddd',
  'MC': '+377 ddddddddd',
  'MN': '+976 ddddddddd',
  'MS': '+1 (ddd) ddd-dddd',
  'MA': '+212 ddddddddd',
  'MZ': '+258 ddddddddd',
  'MM': '+95 ddddddddd',
  'NA': '+264 ddddddddd',
  'NR': '+674 ddddddddd',
  'NP': '+977 ddddddddd',
  'NL': '+31 ddddddddd',
  'AN': '+599 ddddddddd',
  'NC': '+687 ddddddddd',
  'NZ': '+64 ddddddddd',
  'NI': '+505 ddddddddd',
  'NE': '+227 ddddddddd',
  'NG': '+234 ddddddddd',
  'NU': '+683 ddddddddd',
  'NF': '+672 ddddddddd',
  'KP': '+850 ddddddddd',
  'MP': '+1 (ddd) ddd-dddd',
  'NO': '+47 ddddddddd',
  'OM': '+968 ddddddddd',
  'PK': '+92 ddddddddd',
  'PW': '+680 ddddddddd',
  'PA': '+507 ddddddddd',
  'PG': '+675 ddddddddd',
  'PY': '+595 ddddddddd',
  'PE': '+51 ddddddddd',
  'PH': '+63 ddddddddd',
  'PN': '+870 ddddddddd',
  'PL': '+48 ddddddddd',
  'PT': '+351 ddddddddd',
  'PR': '+1 (ddd) ddd-dddd',
  'QA': '+974 ddddddddd',
  'RE': '+262 ddddddddd',
  'RO': '+40 ddddddddd',
  'RU': '+7 ddddddddd',
  'RW': '+250 ddddddddd',
  'ST': '+239 ddddddddd',
  'SH': '+290 ddddddddd',
  'KN': '+1 (ddd) ddd-dddd',
  'LC': '+1 (ddd) ddd-dddd',
  'PM': '+508 ddddddddd',
  'VC': '+1 (ddd) ddd-dddd',
  'WS': '+685 ddddddddd',
  'SM': '+378 ddddddddd',
  'SA': '+966 ddddddddd',
  'SN': '+221 ddddddddd',
  'SC': '+248 ddddddddd',
  'SL': '+232 ddddddddd',
  'SG': '+65 ddddddddd',
  'SK': '+421 ddddddddd',
  'SI': '+386 ddddddddd',
  'SB': '+677 ddddddddd',
  'SO': '+252 ddddddddd',
  'ZA': '+27 ddddddddd',
  'GS': '+0 ddddddddd',
  'KR': '+82 ddddddddd',
  'ES': '+34 ddddddddd',
  'LK': '+94 ddddddddd',
  'SD': '+249 ddddddddd',
  'SR': '+597 ddddddddd',
  'SJ': '+0 ddddddddd',
  'SZ': '+268 ddddddddd',
  'SE': '+46 ddddddddd',
  'CH': '+41 ddddddddd',
  'SY': '+963 ddddddddd',
  'TW': '+886 ddddddddd',
  'TJ': '+992 ddddddddd',
  'TZ': '+255 ddddddddd',
  'TH': '+66 ddddddddd',
  'BS': '+1 (ddd) ddd-dddd',
  'GM': '+220 ddddddddd',
  'TG': '+228 ddddddddd',
  'TK': '+690 ddddddddd',
  'TO': '+676 ddddddddd',
  'TT': '+1 (ddd) ddd-dddd',
  'TN': '+216 ddddddddd',
  'TR': '+90 ddddddddd',
  'TM': '+993 ddddddddd',
  'TC': '+1 (ddd) ddd-dddd',
  'TV': '+688 ddddddddd',
  'VI': '+1 (ddd) ddd-dddd',
  'UG': '+256 ddddddddd',
  'UA': '+380 ddddddddd',
  'AE': '+971 ddddddddd',
  'GB': '+44 (ddd) dddd dddd',
  'US': '+1 (ddd) ddd-dddd',
  'UM': '+0 ddddddddd',
  'UY': '+598 ddddddddd',
  'UZ': '+998 ddddddddd',
  'VU': '+678 ddddddddd',
  'VA': '+39 ddddddddd',
  'VE': '+58 ddddddddd',
  'VN': '+84 ddddddddd',
  'WF': '+681 ddddddddd',
  'EH': '+0 ddddddddd',
  'YE': '+967 ddddddddd',
  'YU': '+0 ddddddddd',
  'ZM': '+260 ddddddddd',
  'ZW': '+263 ddddddddd'
};





/* ==========================================================
 * bootstrap-formhelpers-countries.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

+function ($) {

  'use strict';


  /* COUNTRIES CLASS DEFINITION
   * ====================== */

  var BFHCountries = function (element, options) {
    this.options = $.extend({}, $.fn.bfhcountries.defaults, options);
    this.$element = $(element);

    if (this.$element.is('select')) {
      this.addCountries();
    }

    if (this.$element.hasClass('bfh-selectbox')) {
      this.addBootstrapCountries();
    }

    if (this.$element.is('span')) {
      this.displayCountry();
    }
  };

  BFHCountries.prototype = {

    constructor: BFHCountries,

    getCountries: function() {
      var country,
          countries;

      if (this.options.available) {
        if (typeof this.options.available === 'string') {
          countries = [];
  
          this.options.available = this.options.available.split(',');
  
          for (country in BFHCountriesList) {
            if (BFHCountriesList.hasOwnProperty(country)) {
              if ($.inArray(country, this.options.available) >= 0) {
                countries[country] = BFHCountriesList[country];
              }
            }
          }
        } else {
          countries = this.options.available;
        }

        return countries;
      } else {
        return BFHCountriesList;
      }
    },

    addCountries: function () {
      var value,
          country,
          countries;

      value = this.options.country;
      countries = this.getCountries();

      this.$element.html('');

      if (this.options.blank === true) {
        this.$element.append('<option value=""></option>');
      }

      for (country in countries) {
        if (countries.hasOwnProperty(country)) {
          this.$element.append('<option value="' + country + '">' + countries[country] + '</option>');
        }
      }

      this.$element.val(value);
    },

    addBootstrapCountries: function() {
      var $input,
          $toggle,
          $options,
          value,
          country,
          countries;

      value = this.options.country;
      $input = this.$element.find('input[type="hidden"]');
      $input.addClass('country');
      $toggle = this.$element.find('.bfh-selectbox-option');
      $options = this.$element.find('[role=option]');
      countries = this.getCountries();

      $options.html('');

      // if (this.options.blank === true) {
      //   $options.append('<li><a tabindex="-1" href="#" data-option=""></a></li>');
      // }

      for (country in countries) {
        if (countries.hasOwnProperty(country)) {
          if (this.options.flags === true) {
            $options.append('<li><a tabindex="-1" href="#" data-option="' + country + '"><i class="glyphicon bfh-flag-' + country + '"></i>' + countries[country] + '</a></li>');
          } else {
            $options.append('<li><a tabindex="-1" href="#" data-option="' + country + '">' + countries[country] + '</a></li>');
          }
        }
      }

      this.$element.val(value);
    },

    displayCountry: function () {
      var value;

      value = this.options.country;

      if (this.options.flags === true) {
        this.$element.html('<i class="glyphicon bfh-flag-' + value + '"></i> ' + BFHCountriesList[value]);
      } else {
        this.$element.html(BFHCountriesList[value]);
      }
    }

  };


  /* COUNTRY PLUGIN DEFINITION
   * ======================= */

  var old = $.fn.bfhcountries;

  $.fn.bfhcountries = function (option) {
    return this.each(function () {
      var $this,
          data,
          options;

      $this = $(this);
      data = $this.data('bfhcountries');
      options = typeof option === 'object' && option;

      if (!data) {
        $this.data('bfhcountries', (data = new BFHCountries(this, options)));
      }
      if (typeof option === 'string') {
        data[option].call($this);
      }
    });
  };

  $.fn.bfhcountries.Constructor = BFHCountries;

  $.fn.bfhcountries.defaults = {
    country: '',
    available: '',
    flags: false,
    blank: true
  };


  /* COUNTRY NO CONFLICT
   * ========================== */

  $.fn.bfhcountries.noConflict = function () {
    $.fn.bfhcountries = old;
    return this;
  };


  /* COUNTRY DATA-API
   * ============== */

  $(document).ready( function () {
    $('form select.bfh-countries, span.bfh-countries, div.bfh-countries').each(function () {
      var $countries;

      $countries = $(this);

      if ($countries.hasClass('bfh-selectbox')) {
        $countries.bfhselectbox($countries.data());
      }
      $countries.bfhcountries($countries.data());
    });
  });

}(window.jQuery);




/* ==========================================================
 * bootstrap-formhelpers-phone.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

+function ($) {

  'use strict';


  /* PHONE CLASS DEFINITION
   * ====================== */

  var BFHPhone = function (element, options) {
    this.options = $.extend({}, $.fn.bfhphone.defaults, options);
    this.$element = $(element);

    if (this.$element.is('input[type="text"]') || this.$element.is('input[type="tel"]')) {
      this.addFormatter();
    }

    if (this.$element.is('span')) {
      this.displayFormatter();
    }
  };

  BFHPhone.prototype = {

    constructor: BFHPhone,

    addFormatter: function() {
      var $country;

      if (this.options.country !== '') {
        $country = $(document).find('#' + this.options.country);

        if ($country.length !== 0) {
          this.options.format = BFHPhoneFormatList[$country.val()];
          $country.on('change', {phone: this}, this.changeCountry);
        } else {
          this.options.format = BFHPhoneFormatList[this.options.country];
        }
      }
      
      this.$element.on('keyup.bfhphone.data-api', BFHPhone.prototype.change);

      this.loadFormatter();
    },

    loadFormatter: function () {
      var formattedNumber;

      formattedNumber = formatNumber(this.options.format, this.$element.val());

      this.$element.val(formattedNumber);
    },

    displayFormatter: function () {
      var formattedNumber;

      if (this.options.country !== '') {
        this.options.format = BFHPhoneFormatList[this.options.country];
      }

      formattedNumber = formatNumber(this.options.format, this.options.number);

      this.$element.html(formattedNumber);
    },

    changeCountry: function (e) {
      var $this,
          $phone;

      $this = $(this);
      $phone = e.data.phone;

      $phone.$element.val(String($phone.$element.val()).replace(/\+\d*/g, ''));
      $phone.options.format = BFHPhoneFormatList[$this.val()];

      $phone.loadFormatter();
    },

    change: function(e) {
      var $this,
          cursorPosition,
          cursorEnd,
          formattedNumber;

      $this = $(this).data('bfhphone');

      if ($this.$element.is('.disabled') || $this.$element.attr('disabled') !== undefined) {
        return true;
      }

      cursorPosition = getCursorPosition($this.$element[0]);

      cursorEnd = false;
      if (cursorPosition === $this.$element.val().length) {
        cursorEnd = true;
      }
      
      if (e.which === 8 && $this.options.format.charAt($this.$element.val().length) !== 'd') {
        $this.$element.val(String($this.$element.val()).substring(0, $this.$element.val().length - 1));
      }

      formattedNumber = formatNumber($this.options.format, $this.$element.val());
      
      if (formattedNumber === $this.$element.val()) {
        return true;
      }
      
      $this.$element.val(formattedNumber);

      if (cursorEnd) {
        cursorPosition = $this.$element.val().length;
      }

      setCursorPosition($this.$element[0], cursorPosition);

      return true;
    }

  };

  function formatNumber(format, number) {
    var formattedNumber,
        indexFormat,
        indexNumber,
        lastCharacter;

    formattedNumber = '';
    number = String(number).replace(/\D/g, '');

    for (indexFormat = 0, indexNumber = 0; indexFormat < format.length; indexFormat = indexFormat + 1) {
      if (/\d/g.test(format.charAt(indexFormat))) {
        if (format.charAt(indexFormat) === number.charAt(indexNumber)) {
          formattedNumber += number.charAt(indexNumber);
          indexNumber = indexNumber + 1;
        } else {
          formattedNumber += format.charAt(indexFormat);
        }
      } else if (format.charAt(indexFormat) !== 'd') {
        if (number.charAt(indexNumber) !== '' || format.charAt(indexFormat) === '+') {
          formattedNumber += format.charAt(indexFormat);
        }
      } else {
        if (number.charAt(indexNumber) === '') {
          formattedNumber += '';
        } else {
          formattedNumber += number.charAt(indexNumber);
          indexNumber = indexNumber + 1;
        }
      }
    }
    
    lastCharacter = format.charAt(formattedNumber.length);
    if (lastCharacter !== 'd') {
      formattedNumber += lastCharacter;
    }

    return formattedNumber;
  }

  function getCursorPosition($element) {
    var position = 0,
        selection;

    if (document.selection) {
      // IE Support
      $element.focus();
      selection = document.selection.createRange();
      selection.moveStart ('character', -$element.value.length);
      position = selection.text.length;
    } else if ($element.selectionStart || $element.selectionStart === 0) {
      position = $element.selectionStart;
    }

    return position;
  }

  function setCursorPosition($element, position) {
    var selection;

    if (document.selection) {
      // IE Support
      $element.focus ();
      selection = document.selection.createRange();
      selection.moveStart ('character', -$element.value.length);
      selection.moveStart ('character', position);
      selection.moveEnd ('character', 0);
      selection.select ();
    } else if ($element.selectionStart || $element.selectionStart === 0) {
      $element.selectionStart = position;
      $element.selectionEnd = position;
      $element.focus ();
    }
  }

  /* PHONE PLUGIN DEFINITION
   * ======================= */

  var old = $.fn.bfhphone;

  $.fn.bfhphone = function (option) {
    return this.each(function () {
      var $this,
          data,
          options;

      $this = $(this);
      data = $this.data('bfhphone');
      options = typeof option === 'object' && option;

      if (!data) {
        $this.data('bfhphone', (data = new BFHPhone(this, options)));
      }
      if (typeof option === 'string') {
        data[option].call($this);
      }
    });
  };

  $.fn.bfhphone.Constructor = BFHPhone;

  $.fn.bfhphone.defaults = {
    format: '',
    number: '',
    country: ''
  };


  /* PHONE NO CONFLICT
   * ========================== */

  $.fn.bfhphone.noConflict = function () {
    $.fn.bfhphone = old;
    return this;
  };


  /* PHONE DATA-API
   * ============== */

  $(document).ready( function () {
    $('form input[type="text"].bfh-phone, form input[type="tel"].bfh-phone, span.bfh-phone').each(function () {
      var $phone;

      $phone = $(this);

      $phone.bfhphone($phone.data());
    });
  });

}(window.jQuery);

/* ==========================================================
 * bootstrap-formhelpers-selectbox.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

+function ($) {

  'use strict';


  /* SELECTBOX CLASS DEFINITION
   * ========================= */

  var toggle = '[data-toggle=bfh-selectbox]',
      BFHSelectBox = function (element, options) {
        this.options = $.extend({}, $.fn.bfhselectbox.defaults, options);
        this.$element = $(element);

        this.initSelectBox();
      };

  BFHSelectBox.prototype = {

    constructor: BFHSelectBox,

    initSelectBox: function () {
      var options;

      options = '';
      this.$element.find('div').each(function() {
        options = options + '<li><a tabindex="-1" href="#" data-option="' + $(this).data('value') + '">' + $(this).html() + '</a></li>';
      });

      this.$element.html(
        '<input type="hidden" name="' + this.options.name + '" value="">' +
		'<a class="bfh-selectbox-toggle   ' + this.options.input + '" role="button" data-toggle="bfh-selectbox" href="#" style="padding: 8px 20px;">' +
		'<span class="bfh-selectbox-option"></span>' +
		'</a>' +
		'<div class="bfh-selectbox-options">' +
		'<div role="listbox">' +
		'<ul role="option">' +
		'</ul>' +
		'</div>' +
		'</div>'
      );

      this.$element.find('[role=option]').html(options);

      if (this.options.filter === true) {
        this.$element.find('.bfh-selectbox-options').prepend('<div class="bfh-selectbox-filter-container"><input type="text" class="bfh-selectbox-filter form-control" placeholder="Search" autofocus></div>');
      }

      this.$element.val(this.options.value);

      this.$element
        .on('click.bfhselectbox.data-api touchstart.bfhselectbox.data-api', toggle, BFHSelectBox.prototype.toggle)
		.on('keydown.bfhselectbox.data-api', toggle + ', [role=option]' , BFHSelectBox.prototype.keydown)
		.on('mouseenter.bfhselectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter)
		.on('click.bfhselectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.select)
		.on('click.bfhselectbox.data-api', '.bfh-selectbox-filter', function () { return false; })
		.on('propertychange.bfhselectbox.data-api change.bfhselectbox.data-api input.bfhselectbox.data-api paste.bfhselectbox.data-api', '.bfh-selectbox-filter', BFHSelectBox.prototype.filter);
    },

    toggle: function (e) {
      var $this,
          $parent,
          isActive;

      $this = $(this);
      $parent = getParent($this);

      if ($parent.is('.disabled') || $parent.attr('disabled') !== undefined) {
        return true;
      }

      isActive = $parent.hasClass('open');

      clearMenus();

      if (!isActive) {
        $parent.trigger(e = $.Event('show.bfhselectbox'));

        if (e.isDefaultPrevented()) {
          return true;
        }

        $parent
          .toggleClass('open')
          .trigger('shown.bfhselectbox')
          .find('[role=option] > li > [data-option="' + $parent.val() + '"]').focus();
      }

      return false;
    },

    filter: function() {
      var $this,
          $parent,
          $items;

      $this = $(this);
      $parent = getParent($this);

      $items = $('[role=option] li a', $parent);
      $items
        .hide()
        .filter(function() {
          return ($(this).text().toUpperCase().indexOf($this.val().toUpperCase()) !== -1);
        })
        .show();
    },

    keydown: function (e) {
      var $this,
          $items,
          $parent,
          $subItems,
          isActive,
          index,
          selectedIndex;

      if (!/(38|40|27)/.test(e.keyCode)) {
        return true;
      }

      $this = $(this);

      e.preventDefault();
      e.stopPropagation();

      $parent = getParent($this);
      isActive = $parent.hasClass('open');

      if (!isActive || (isActive && e.keyCode === 27)) {
        if (e.which === 27) {
          $parent.find(toggle).focus();
        }

        return $this.click();
      }

      $items = $('[role=option] li:not(.divider) a:visible', $parent);

      if (!$items.length) {
        return true;
      }

      $('body').off('mouseenter.bfh-selectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter);
      index = $items.index($items.filter(':focus'));

      if (e.keyCode === 38 && index > 0) {
        index = index - 1;
      }

      if (e.keyCode === 40 && index < $items.length - 1) {
        index = index + 1;
      }

      if (!index) {
        index = 0;
      }

      $items.eq(index).focus();
      $('body').on('mouseenter.bfh-selectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter);
    },

    mouseenter: function () {
      var $this;

      $this = $(this);

      $this.focus();
    },

    select: function (e) {
      var $this,
          $parent,
          $span,
          $input;

      $this = $(this);

      e.preventDefault();
      e.stopPropagation();

      if ($this.is('.disabled') || $this.attr('disabled') !== undefined) {
        return true;
      }

      $parent = getParent($this);

      $parent.val($this.data('option'));
      $parent.trigger('change.bfhselectbox');

      clearMenus();
    }

  };

  function clearMenus() {
    var $parent;

    $(toggle).each(function (e) {
      $parent = getParent($(this));

      if (!$parent.hasClass('open')) {
        return true;
      }

      $parent.trigger(e = $.Event('hide.bfhselectbox'));

      if (e.isDefaultPrevented()) {
        return true;
      }

      $parent
        .removeClass('open')
        .trigger('hidden.bfhselectbox');
    });
  }

  function getParent($this) {
    return $this.closest('.bfh-selectbox');
  }


  /* SELECTBOX PLUGIN DEFINITION
   * ========================== */

  var old = $.fn.bfhselectbox;

  $.fn.bfhselectbox = function (option) {
    return this.each(function () {
      var $this,
          data,
          options;

      $this = $(this);
      data = $this.data('bfhselectbox');
      options = typeof option === 'object' && option;
      this.type = 'bfhselectbox';

      if (!data) {
        $this.data('bfhselectbox', (data = new BFHSelectBox(this, options)));
      }
      if (typeof option === 'string') {
        data[option].call($this);
      }
    });
  };

  $.fn.bfhselectbox.Constructor = BFHSelectBox;

  $.fn.bfhselectbox.defaults = {
    icon: 'caret',
    input: 'form-control',
    name: '',
    value: '',
    filter: true
  };


  /* SELECTBOX NO CONFLICT
   * ========================== */

  $.fn.bfhselectbox.noConflict = function () {
    $.fn.bfhselectbox = old;
    return this;
  };


  /* SELECTBOX VALHOOKS
   * ========================== */

  var origHook;
  if ($.valHooks.div){
    origHook = $.valHooks.div;
  }
  $.valHooks.div = {
    get: function(el) {
      if ($(el).hasClass('bfh-selectbox')) {
        return $(el).find('input[type="hidden"]').val();
      } else if (origHook) {
        return origHook.get(el);
      }
    },
    set: function(el, val) {
      var $el,
          html;

      if ($(el).hasClass('bfh-selectbox')) {

        $el = $(el);
        if ($el.find('li a[data-option=\'' + val + '\']').length > 0) {
          html = $el.find('li a[data-option=\'' + val + '\']').html();
        } else if ($el.find('li a').length > 0) {
          html = $el.find('li a').eq(0).html();
        } else {
          val = '';
          html = '';
        }

        $el.find('input[type="hidden"]').val(val);
        $el.find('.bfh-selectbox-option').html(html);
      } else if (origHook) {
        return origHook.set(el,val);
      }
    }
  };


  /* SELECTBOX DATA-API
   * ============== */

  $(document).ready( function () {
    $('div.bfh-selectbox').each(function () {
      var $selectbox;

      $selectbox = $(this);

      $selectbox.bfhselectbox($selectbox.data());
    });
  });


  /* APPLY TO STANDARD SELECTBOX ELEMENTS
   * =================================== */

  $(document)
    .on('click.bfhselectbox.data-api', clearMenus);

}(window.jQuery);








    // function test(){
    //    // alert($(':hidden.country').val());
    //    var $pickedcountry = $(':hidden.country').val();
    //    $('#country-phone').attr('data-country', $pickedcountry);
    //    $('#input-phone').data('country', $pickedcountry);
    //    $.getScript('js/bootstrap-formhelpers.js');
       
    // }
