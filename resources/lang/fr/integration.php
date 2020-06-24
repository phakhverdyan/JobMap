<?php

return [
    'title' => "Quel canal d'embauche souhaitez-vous rendre <strong>inexpirable</strong> ?",
    
    'header' => [
        'in_store' => "En Succursale",
        'email' => "Email",
        'website' => "Site web",
        'career_page' => "Page carrière",
        'social' => "Social",
        'job_boards' => "Sites d'embauches",
        'staffing_agencies' => "Agence de placement",
        'ats' => "ATS/Excel",
    
        'current_step' => 'Étape en cours',
        'next_step' => 'Étape suivante',
        'fill_in_your' => 'Remplissez votre',
        'complete_percent' => 'Votre intégration est <strong id="progress-percent"></strong> complété',
    ],
    
    'items' => [
        'website' => "bouton de Site web",
        'import' => "Importation ATS",
        'cr_email' => "Email CR",
        'email_fr' => "Redirecteur d'email",
        'scan' => "Scanner de CV",
        'career' => "Lien vers la Page Carrière",
        'boards' => "Sites d'embauches",
        'social' => "Médias sociaux",
        'posting' => "Annonces d'emploi gratuite",
    ],
    
    'tabs' => [
        'website' => "<span class=\"part_rb\">Bouton</span>&nbsp;de site web</span>",
        'import' => "Importation",
        'cr_email' => "Email CR",
        'email_fr' => "<span class=\"part_rb\">Email</span>&nbsp;Forwarder",
        'scan' => "<span class=\"part_rb\">Scanner</span>&nbsp;de CV",
        'career' => "<span class=\"part_rb\">Lien vers </span>&nbsp;Page&nbsp;<span class=\"part_rb\">carrière</span>",
        'boards' => "<span class=\"part_rb\">Emploi</span>&nbsp;Boards",
        'social' => "<span class=\"part_rb\">Médias</span>&nbsp;Sociaux",
        'posting' => "<span class=\"part_rb\">Annonce d'emploi</span>&nbsp;Gratuite",
    ],
    
    'website' => [
        'title' => "Rassemblez des candidats actifs directement à partir de votre site Web en ajoutant un lien direct à votre page Carrières JobMap.",
        'time' => "2 min",
        'link_1' => "Créez votre bouton personnalisé",
        'link_2' => "Collez le code",
        'link_3' => "Recevez les candidats actifs",
        'text_box_1' => [
        'title' => "Comment ça marche",
        'text' => "Les visiteurs accèdent à votre site Web et cliquent sur votre bouton pour voir votre page carrière JobMap. Ils peuvent appliquer et voir toutes vos offres d'emplois ouverts et fermés."
        ],
        'hint' => "<p class=\"text-center\">
                				Cette section peut vous demander de contacter votre administrateur informatique/site Web pour copier le code, ce qui prend <strong>moins de 10 secs</strong> à compléter.
                			</p>
                			<p class=\"text-center mb-0\">Dites-leur simplement l'emplacement exact sur la page où vous voulez intégrer ce bouton.</p>",
        'text_box_2' => [
            'title' => "Étape pour l'intégration",
            'text' => "<li>Accédez à la page de votre bouton dans le menu de gauche <a href=\"/business/button/manager\" class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</a></li>
		                	<li class=\"mt-3\">Choisissez les couleurs, les textes, les espaces, les bordures pour que votre bouton ressemble à votre site Web</li>
		                	<li class=\"mt-3\">Sauvegardez le bouton, cela générera le Code</li>
		                	<li class=\"mt-3\">Collez-le n'importe où sur la partie HTML du site Web où vous souhaitez qu'il apparaisse</li>
		                	<li class=\"mt-3\"><img src=\":image\" style=\"margin-top: -3px;\" class=\"mr-3\"><strong>Profitez de candidats actifs</strong></li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Mettez-le sur votre page principale, pied de page ou en-tête ...</li>
                	<li class=\"mt-2\">Si vous avez une page de carrière, ajoutez-la à un espace visible</li>"
        ]
    ],
    
    'import' => [
        'title' => "Transformez instantanément vos candidats statiques en candidats inexpirable, pour toujours!",
        'time' => "5 min",
        'link_1' => "Exporter dans un fichier excel/csv",
        'link_2' => "Télécharger dans JobMap",
        'link_3' => "Si les candidats répondent, ils deviennent tous inexpirables",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "Si vous utilisez déjà un ATS ou stockez vos candidats dans une liste Excel, téléversez-les simplement dans la section Importation."
        ],
        'hint' => "Vous pouvez facilement rechercher dans Google les étapes pour exporter des candidats de votre système ATS.",
        'text_box_2' => [
            'title' => "Étapes à suivre pour intégrer",
            'text' => "<li>À partir de l'ATS, exportez les candidats dans une feuille Excel ou préparez votre feuille Excel/CSV</li>
		                	<li class=\"mt-3\">Allez dans votre <strong>Page Importation</strong> depuis le menu de gauche. <button class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</button></li>
		                	<li class=\"mt-3\">Cliquez sur le bouton de téléversement</li>
		                	<li class=\"mt-3\"><img src=\":image\" style=\"margin-top: -3px;\" class=\"mr-3\"><strong>Cela informera vos candidats instantanément</strong></li>
                            <li class=\"mt-3\">Les candidats intéressés apparaîtront dans votre pipeline de candidats sous \"ATS\".</li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Lorsque vous exportez, la seule colonne nécessaire est email, le reste peux être ignoré.</li>"
        ]
    ],
    
    'cr_email' => [
        'title' => "Utilisez-vous des fournisseurs de messagerie gratuits pour recruter? Amenez votre recrutement au niveau supérieur",
        'time' => "30 secondes",
        'link_1' => "Saisissez votre identifiant d'email JobMap",
        'link_2' => "Affichez-le partout",
        'link_3' => "Les candidats créent leur JobMaps",
        'link_4' => "Ils deviennent inexpirables",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "Utilisez votre Email JobMap pour rassembler les candidats de vos publications sociales, de votre site Web, affichez-les partout"
        ],
        'hint' => "Postez ceci sur LinkedIn, Indeed, Facebook, sur votre site web, etc ...",
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Obtenez votre email JobMap depuis la section CR EMail dans le menu de gauche<button class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</button></li>
		                	<li class=\"mt-3\">Utilisez-le sur les médias sociaux, au lieu de e.g: <strong>company.jobs@gmail.com</strong></li>
		                	<li class=\"mt-3\"><strong>Exemple de message LinkedIn</strong></li>
		                	<li class=\"d-flex justify-content-between flex-column flex-lg-row\">
		                		<div class=\"col-lg-6 col-12 pl-0 pxa-0\">
		                			<p class=\"text-center\"><strong>Avant</strong></p>
		                			<p>Hey! Nous avons 3 postes de vente ouverts maintenant.</p>
									<p>Intéressé ou connaissez quelqu'un?</p>
									<p>Envoyez-le à <strong>jobs.superbagels@gmail.com</strong></p>
		                		</div>
		                		<div class=\"col-lg-6 col-12 pr-0 pxa-0\">
		                			<p class=\"text-center\"><strong>Après</strong></p>
		                			<p>Hey! Nous avons 3 postes de vente ouverts maintenant.</p>
									<p>Intéressé ou connaissez quelqu'un?</p>
									<p>Envoyez-le à <strong>superbagels@JobMap.co</strong></p>
		                		</div>
		                	</li>
		                	<li class=\"mt-3\"><img src=\":image\" style=\"margin-top: -3px;\" class=\"mr-3\"><strong>Les candidats créeront des JobMap au lieu de vous envoyer des CV statiques</strong></li>
                            <li class=\"mt-3\">Les candidats intéressés apparaîtront dans votre pipeline de candidats sous \"Nouveau\":</li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">XXXXXXXXXXXXXXXXXXXXX</li>"
        ]
    ],
    
    'email_fr' => [
        'title' => "Cessez de recevoir des CV statiques expirés par courriel",
        'time' => "2 minutes",
        'link_1' => "Copiez votre adresse de redirecteur d'e-mail",
        'link_2' => "Collez-le dans vos paramètres de messagerie",
        'link_3' => "Les candidats créent leurs JobMaps",
        'link_4' => "Ils deviennent inexpirables",
        'text_box_1' => [
          'title' => "Comment ça marche",
            'text' => "Lorsque les candidats envoient leurs CV à l'adresse de votre entreprise, ils reçoivent une notification afin de créer leur JobMap et ne plus jamais expirer."
        ],
        'hint' => "Conservez tous les candidats que vous recevez depuis votre email.",
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Accédez à votre menu Redirecteur d'e-mails JobMap<button class=\"btn btn-primary btn-sm ml-3\">:button</button></li>
		                	<li class=\"mt-3\">Copiez l'adresse, par exemple: <strong>forward.483333@JobMap.co</strong></li>
		                	<li class=\"mt-3\"><strong>Lorsque les candidats envoient leurs CV statiques attachés à votre email RH...</strong></li>
		                	<li class=\"mt-3\"><img src=\":image\" style=\"margin-top: -3px;\" class=\"mr-3\"><strong>Les candidats créeront des JobMap au lieu de vous envoyer des CV statiques</strong></li>
                            <li class=\"mt-3\">Les candidats intéressés apparaîtront dans votre pipeline de candidats sous \"Nouveau\":</li>"
        ],
        'text_box_3' => [
            'title' => "",
            'text' => ""
        ]
    ],
    
    'scan' => [
        'title' => "Rendez les CV en succursale inexpirable",
        'time' => "1 minute entre l'installation et le premier scan",
        'link_1' => "Obtenez l'application JobMap",
        'link_2' => "Connectez-vous en tant qu'entreprise",
        'link_3' => "Placez l'appareil au dessus du CV",
        'link_4' => "Ils deviennent inexpirables",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "Lorsque les candidats remettent un CV papier, tout gestionnaire peut utiliser l'application pour numériser le document. Cela invite le candidat à créer un JobMap"
        ],
        'hint' => "Conservez tous les candidats que vous recevez par votre email.",
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Accédez au Google Play Store ou à l'AppStore</li>
                            <li class=\"d-flex justify-content-around mt-2 flex-column flex-lg-row\">
                                <div class=\"col-lg-4 col-12\">
                                    <p class=\"text-center mb-0 mt-3\">
                                        <a href=\"#\">
                                            <svg xmlns=\"http://www.w3.org/2000/svg\"
                                                 xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\"
                                                 id=\"US_UK_Download_on_the\" x=\"0px\" y=\"0px\" width=\"135px\" height=\"40px\"
                                                 viewBox=\"0 0 135 40\" enable-background=\"new 0 0 135 40\"
                                                 xml:space=\"preserve\">
                                            <g>
                                                <path fill=\"#A6A6A6\"
                                                      d=\"M130.197,40H4.729C2.122,40,0,37.872,0,35.267V4.726C0,2.12,2.122,0,4.729,0h125.468   C132.803,0,135,2.12,135,4.726v30.541C135,37.872,132.803,40,130.197,40L130.197,40z\"/>
                                                <path d=\"M134.032,35.268c0,2.116-1.714,3.83-3.834,3.83H4.729c-2.119,0-3.839-1.714-3.839-3.83V4.725   c0-2.115,1.72-3.835,3.839-3.835h125.468c2.121,0,3.834,1.72,3.834,3.835L134.032,35.268L134.032,35.268z\"/>
                                                <g>
                                                    <g>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M30.128,19.784c-0.029-3.223,2.639-4.791,2.761-4.864c-1.511-2.203-3.853-2.504-4.676-2.528     c-1.967-0.207-3.875,1.177-4.877,1.177c-1.022,0-2.565-1.157-4.228-1.123c-2.14,0.033-4.142,1.272-5.24,3.196     c-2.266,3.923-0.576,9.688,1.595,12.859c1.086,1.553,2.355,3.287,4.016,3.226c1.625-0.067,2.232-1.036,4.193-1.036     c1.943,0,2.513,1.036,4.207,0.997c1.744-0.028,2.842-1.56,3.89-3.127c1.255-1.78,1.759-3.533,1.779-3.623     C33.507,24.924,30.161,23.647,30.128,19.784z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M26.928,10.306c0.874-1.093,1.472-2.58,1.306-4.089c-1.265,0.056-2.847,0.875-3.758,1.944     c-0.806,0.942-1.526,2.486-1.34,3.938C24.557,12.205,26.016,11.382,26.928,10.306z\"/>
                                                    </g>
                                                </g>
                                                <g>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M53.645,31.504h-2.271l-1.244-3.909h-4.324l-1.185,3.909h-2.211l4.284-13.308h2.646L53.645,31.504z     M49.755,25.955L48.63,22.48c-0.119-0.355-0.342-1.191-0.671-2.507h-0.04c-0.131,0.566-0.342,1.402-0.632,2.507l-1.105,3.475    H49.755z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M64.662,26.588c0,1.632-0.441,2.922-1.323,3.869c-0.79,0.843-1.771,1.264-2.942,1.264    c-1.264,0-2.172-0.454-2.725-1.362h-0.04v5.055h-2.132V25.067c0-1.026-0.027-2.079-0.079-3.159h1.875l0.119,1.521h0.04    c0.711-1.146,1.79-1.718,3.238-1.718c1.132,0,2.077,0.447,2.833,1.342C64.284,23.949,64.662,25.127,64.662,26.588z M62.49,26.666    c0-0.934-0.21-1.704-0.632-2.31c-0.461-0.632-1.08-0.948-1.856-0.948c-0.526,0-1.004,0.176-1.431,0.523    c-0.428,0.35-0.708,0.807-0.839,1.373c-0.066,0.264-0.099,0.48-0.099,0.65v1.6c0,0.698,0.214,1.287,0.642,1.768    s0.984,0.721,1.668,0.721c0.803,0,1.428-0.31,1.875-0.928C62.266,28.496,62.49,27.68,62.49,26.666z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M75.699,26.588c0,1.632-0.441,2.922-1.324,3.869c-0.789,0.843-1.77,1.264-2.941,1.264    c-1.264,0-2.172-0.454-2.724-1.362H68.67v5.055h-2.132V25.067c0-1.026-0.027-2.079-0.079-3.159h1.875l0.119,1.521h0.04    c0.71-1.146,1.789-1.718,3.238-1.718c1.131,0,2.076,0.447,2.834,1.342C75.32,23.949,75.699,25.127,75.699,26.588z M73.527,26.666    c0-0.934-0.211-1.704-0.633-2.31c-0.461-0.632-1.078-0.948-1.855-0.948c-0.527,0-1.004,0.176-1.432,0.523    c-0.428,0.35-0.707,0.807-0.838,1.373c-0.065,0.264-0.099,0.48-0.099,0.65v1.6c0,0.698,0.214,1.287,0.64,1.768    c0.428,0.48,0.984,0.721,1.67,0.721c0.803,0,1.428-0.31,1.875-0.928C73.303,28.496,73.527,27.68,73.527,26.666z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M88.039,27.772c0,1.132-0.393,2.053-1.182,2.764c-0.867,0.777-2.074,1.165-3.625,1.165    c-1.432,0-2.58-0.276-3.449-0.829l0.494-1.777c0.936,0.566,1.963,0.85,3.082,0.85c0.803,0,1.428-0.182,1.877-0.544    c0.447-0.362,0.67-0.848,0.67-1.454c0-0.54-0.184-0.995-0.553-1.364c-0.367-0.369-0.98-0.712-1.836-1.029    c-2.33-0.869-3.494-2.142-3.494-3.816c0-1.094,0.408-1.991,1.225-2.689c0.814-0.699,1.9-1.048,3.258-1.048    c1.211,0,2.217,0.211,3.02,0.632l-0.533,1.738c-0.75-0.408-1.598-0.612-2.547-0.612c-0.75,0-1.336,0.185-1.756,0.553    c-0.355,0.329-0.533,0.73-0.533,1.205c0,0.526,0.203,0.961,0.611,1.303c0.355,0.316,1,0.658,1.936,1.027    c1.145,0.461,1.986,1,2.527,1.618C87.77,26.081,88.039,26.852,88.039,27.772z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M95.088,23.508h-2.35v4.659c0,1.185,0.414,1.777,1.244,1.777c0.381,0,0.697-0.033,0.947-0.099l0.059,1.619    c-0.42,0.157-0.973,0.236-1.658,0.236c-0.842,0-1.5-0.257-1.975-0.77c-0.473-0.514-0.711-1.376-0.711-2.587v-4.837h-1.4v-1.6h1.4    v-1.757l2.094-0.632v2.389h2.35V23.508z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M105.691,26.627c0,1.475-0.422,2.686-1.264,3.633c-0.883,0.975-2.055,1.461-3.516,1.461    c-1.408,0-2.529-0.467-3.365-1.401s-1.254-2.113-1.254-3.534c0-1.487,0.43-2.705,1.293-3.652c0.861-0.948,2.023-1.422,3.484-1.422    c1.408,0,2.541,0.467,3.396,1.402C105.283,24.021,105.691,25.192,105.691,26.627z M103.479,26.696    c0-0.885-0.189-1.644-0.572-2.277c-0.447-0.766-1.086-1.148-1.914-1.148c-0.857,0-1.508,0.383-1.955,1.148    c-0.383,0.634-0.572,1.405-0.572,2.317c0,0.885,0.189,1.644,0.572,2.276c0.461,0.766,1.105,1.148,1.936,1.148    c0.814,0,1.453-0.39,1.914-1.168C103.281,28.347,103.479,27.58,103.479,26.696z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M112.621,23.783c-0.211-0.039-0.436-0.059-0.672-0.059c-0.75,0-1.33,0.283-1.738,0.85    c-0.355,0.5-0.533,1.132-0.533,1.895v5.035h-2.131l0.02-6.574c0-1.106-0.027-2.113-0.08-3.021h1.857l0.078,1.836h0.059    c0.225-0.631,0.58-1.139,1.066-1.52c0.475-0.343,0.988-0.514,1.541-0.514c0.197,0,0.375,0.014,0.533,0.039V23.783z\"/>
                                                    <path fill=\"#FFFFFF\"
                                                          d=\"M122.156,26.252c0,0.382-0.025,0.704-0.078,0.967h-6.396c0.025,0.948,0.334,1.673,0.928,2.173    c0.539,0.447,1.236,0.671,2.092,0.671c0.947,0,1.811-0.151,2.588-0.454l0.334,1.48c-0.908,0.396-1.98,0.593-3.217,0.593    c-1.488,0-2.656-0.438-3.506-1.313c-0.848-0.875-1.273-2.05-1.273-3.524c0-1.447,0.395-2.652,1.186-3.613    c0.828-1.026,1.947-1.539,3.355-1.539c1.383,0,2.43,0.513,3.141,1.539C121.873,24.047,122.156,25.055,122.156,26.252z     M120.123,25.699c0.014-0.632-0.125-1.178-0.414-1.639c-0.369-0.593-0.936-0.889-1.699-0.889c-0.697,0-1.264,0.289-1.697,0.869    c-0.355,0.461-0.566,1.014-0.631,1.658H120.123z\"/>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M49.05,10.009c0,1.177-0.353,2.063-1.058,2.658c-0.653,0.549-1.581,0.824-2.783,0.824     c-0.596,0-1.106-0.026-1.533-0.078V6.982c0.557-0.09,1.157-0.136,1.805-0.136c1.145,0,2.008,0.249,2.59,0.747     C48.723,8.156,49.05,8.961,49.05,10.009z M47.945,10.038c0-0.763-0.202-1.348-0.606-1.756c-0.404-0.407-0.994-0.611-1.771-0.611     c-0.33,0-0.611,0.022-0.844,0.068v4.889c0.129,0.02,0.365,0.029,0.708,0.029c0.802,0,1.421-0.223,1.857-0.669     S47.945,10.892,47.945,10.038z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M54.909,11.037c0,0.725-0.207,1.319-0.621,1.785c-0.434,0.479-1.009,0.718-1.727,0.718     c-0.692,0-1.243-0.229-1.654-0.689c-0.41-0.459-0.615-1.038-0.615-1.736c0-0.73,0.211-1.329,0.635-1.794s0.994-0.698,1.712-0.698     c0.692,0,1.248,0.229,1.669,0.688C54.708,9.757,54.909,10.333,54.909,11.037z M53.822,11.071c0-0.435-0.094-0.808-0.281-1.119     c-0.22-0.376-0.533-0.564-0.94-0.564c-0.421,0-0.741,0.188-0.961,0.564c-0.188,0.311-0.281,0.69-0.281,1.138     c0,0.435,0.094,0.808,0.281,1.119c0.227,0.376,0.543,0.564,0.951,0.564c0.4,0,0.714-0.191,0.94-0.574     C53.725,11.882,53.822,11.506,53.822,11.071z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M62.765,8.719l-1.475,4.714h-0.96l-0.611-2.047c-0.155-0.511-0.281-1.019-0.379-1.523h-0.019     c-0.091,0.518-0.217,1.025-0.379,1.523l-0.649,2.047h-0.971l-1.387-4.714h1.077l0.533,2.241c0.129,0.53,0.235,1.035,0.32,1.513     h0.019c0.078-0.394,0.207-0.896,0.389-1.503l0.669-2.25h0.854l0.641,2.202c0.155,0.537,0.281,1.054,0.378,1.552h0.029     c0.071-0.485,0.178-1.002,0.32-1.552l0.572-2.202H62.765z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M68.198,13.433H67.15v-2.7c0-0.832-0.316-1.248-0.95-1.248c-0.311,0-0.562,0.114-0.757,0.343     c-0.193,0.229-0.291,0.499-0.291,0.808v2.796h-1.048v-3.366c0-0.414-0.013-0.863-0.038-1.349h0.921l0.049,0.737h0.029     c0.122-0.229,0.304-0.418,0.543-0.569c0.284-0.176,0.602-0.265,0.95-0.265c0.44,0,0.806,0.142,1.097,0.427     c0.362,0.349,0.543,0.87,0.543,1.562V13.433z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M71.088,13.433h-1.047V6.556h1.047V13.433z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M77.258,11.037c0,0.725-0.207,1.319-0.621,1.785c-0.434,0.479-1.01,0.718-1.727,0.718     c-0.693,0-1.244-0.229-1.654-0.689c-0.41-0.459-0.615-1.038-0.615-1.736c0-0.73,0.211-1.329,0.635-1.794s0.994-0.698,1.711-0.698     c0.693,0,1.248,0.229,1.67,0.688C77.057,9.757,77.258,10.333,77.258,11.037z M76.17,11.071c0-0.435-0.094-0.808-0.281-1.119     c-0.219-0.376-0.533-0.564-0.939-0.564c-0.422,0-0.742,0.188-0.961,0.564c-0.188,0.311-0.281,0.69-0.281,1.138     c0,0.435,0.094,0.808,0.281,1.119c0.227,0.376,0.543,0.564,0.951,0.564c0.4,0,0.713-0.191,0.939-0.574     C76.074,11.882,76.17,11.506,76.17,11.071z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M82.33,13.433h-0.941l-0.078-0.543h-0.029c-0.322,0.433-0.781,0.65-1.377,0.65     c-0.445,0-0.805-0.143-1.076-0.427c-0.246-0.258-0.369-0.579-0.369-0.96c0-0.576,0.24-1.015,0.723-1.319     c0.482-0.304,1.16-0.453,2.033-0.446V10.3c0-0.621-0.326-0.931-0.979-0.931c-0.465,0-0.875,0.117-1.229,0.349l-0.213-0.688     c0.438-0.271,0.979-0.407,1.617-0.407c1.232,0,1.85,0.65,1.85,1.95v1.736C82.262,12.78,82.285,13.155,82.33,13.433z      M81.242,11.813v-0.727c-1.156-0.02-1.734,0.297-1.734,0.95c0,0.246,0.066,0.43,0.201,0.553c0.135,0.123,0.307,0.184,0.512,0.184     c0.23,0,0.445-0.073,0.641-0.218c0.197-0.146,0.318-0.331,0.363-0.558C81.236,11.946,81.242,11.884,81.242,11.813z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M88.285,13.433h-0.93l-0.049-0.757h-0.029c-0.297,0.576-0.803,0.864-1.514,0.864     c-0.568,0-1.041-0.223-1.416-0.669s-0.562-1.025-0.562-1.736c0-0.763,0.203-1.381,0.611-1.853c0.395-0.44,0.879-0.66,1.455-0.66     c0.633,0,1.076,0.213,1.328,0.64h0.02V6.556h1.049v5.607C88.248,12.622,88.26,13.045,88.285,13.433z M87.199,11.445v-0.786     c0-0.136-0.01-0.246-0.029-0.33c-0.059-0.252-0.186-0.464-0.379-0.635c-0.195-0.171-0.43-0.257-0.701-0.257     c-0.391,0-0.697,0.155-0.922,0.466c-0.223,0.311-0.336,0.708-0.336,1.193c0,0.466,0.107,0.844,0.322,1.135     c0.227,0.31,0.533,0.465,0.916,0.465c0.344,0,0.619-0.129,0.828-0.388C87.1,12.069,87.199,11.781,87.199,11.445z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M97.248,11.037c0,0.725-0.207,1.319-0.621,1.785c-0.434,0.479-1.008,0.718-1.727,0.718     c-0.691,0-1.242-0.229-1.654-0.689c-0.41-0.459-0.615-1.038-0.615-1.736c0-0.73,0.211-1.329,0.635-1.794s0.994-0.698,1.713-0.698     c0.691,0,1.248,0.229,1.668,0.688C97.047,9.757,97.248,10.333,97.248,11.037z M96.162,11.071c0-0.435-0.094-0.808-0.281-1.119     c-0.221-0.376-0.533-0.564-0.941-0.564c-0.42,0-0.74,0.188-0.961,0.564c-0.188,0.311-0.281,0.69-0.281,1.138     c0,0.435,0.094,0.808,0.281,1.119c0.227,0.376,0.543,0.564,0.951,0.564c0.4,0,0.715-0.191,0.941-0.574     C96.064,11.882,96.162,11.506,96.162,11.071z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M102.883,13.433h-1.047v-2.7c0-0.832-0.316-1.248-0.951-1.248c-0.311,0-0.562,0.114-0.756,0.343     s-0.291,0.499-0.291,0.808v2.796h-1.049v-3.366c0-0.414-0.012-0.863-0.037-1.349h0.92l0.049,0.737h0.029     c0.123-0.229,0.305-0.418,0.543-0.569c0.285-0.176,0.602-0.265,0.951-0.265c0.439,0,0.805,0.142,1.096,0.427     c0.363,0.349,0.543,0.87,0.543,1.562V13.433z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M109.936,9.504h-1.154v2.29c0,0.582,0.205,0.873,0.611,0.873c0.188,0,0.344-0.016,0.467-0.049     l0.027,0.795c-0.207,0.078-0.479,0.117-0.814,0.117c-0.414,0-0.736-0.126-0.969-0.378c-0.234-0.252-0.35-0.676-0.35-1.271V9.504     h-0.689V8.719h0.689V7.855l1.027-0.31v1.173h1.154V9.504z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M115.484,13.433h-1.049v-2.68c0-0.845-0.316-1.268-0.949-1.268c-0.486,0-0.818,0.245-1,0.735     c-0.031,0.103-0.049,0.229-0.049,0.377v2.835h-1.047V6.556h1.047v2.841h0.02c0.33-0.517,0.803-0.775,1.416-0.775     c0.434,0,0.793,0.142,1.078,0.427c0.355,0.355,0.533,0.883,0.533,1.581V13.433z\"/>
                                                        <path fill=\"#FFFFFF\"
                                                              d=\"M121.207,10.853c0,0.188-0.014,0.346-0.039,0.475h-3.143c0.014,0.466,0.164,0.821,0.455,1.067     c0.266,0.22,0.609,0.33,1.029,0.33c0.465,0,0.889-0.074,1.271-0.223l0.164,0.728c-0.447,0.194-0.973,0.291-1.582,0.291     c-0.73,0-1.305-0.215-1.721-0.645c-0.418-0.43-0.625-1.007-0.625-1.731c0-0.711,0.193-1.303,0.582-1.775     c0.406-0.504,0.955-0.756,1.648-0.756c0.678,0,1.193,0.252,1.541,0.756C121.068,9.77,121.207,10.265,121.207,10.853z      M120.207,10.582c0.008-0.311-0.061-0.579-0.203-0.805c-0.182-0.291-0.459-0.437-0.834-0.437c-0.342,0-0.621,0.142-0.834,0.427     c-0.174,0.227-0.277,0.498-0.311,0.815H120.207z\"/>
                                                    </g>
                                                </g>
                                            </g>
                                            </svg>
                                        </a>
                                    </p>
                                </div>
                                <div class=\"col-lg-4 col-12\">
                                    <p class=\"text-center mb-0 mt-3\">
                                        <a href=\"#\">
                                            <svg xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
                                                 xmlns:cc=\"http://creativecommons.org/ns#\"
                                                 xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"
                                                 xmlns:svg=\"http://www.w3.org/2000/svg\"
                                                 xmlns=\"http://www.w3.org/2000/svg\"
                                                 xmlns:sodipodi=\"http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd\"
                                                 xmlns:inkscape=\"http://www.inkscape.org/namespaces/inkscape\" id=\"svg2\"
                                                 version=\"1.1\" inkscape:version=\"0.91 r13725\" xml:space=\"preserve\"
                                                 width=\"135.71649\" height=\"40.018951\" viewBox=\"0 0 135.71649 40.018951\"
                                                 sodipodi:docname=\"google-play-badge.svg\"><metadata id=\"metadata8\">
                                                    <rdf:RDF>
                                                        <cc:Work rdf:about=\"\">
                                                            <dc:format>image/svg+xml</dc:format>
                                                            <dc:type
                                                                    rdf:resource=\"http://purl.org/dc/dcmitype/StillImage\"/>
                                                            <dc:title/>
                                                        </cc:Work>
                                                    </rdf:RDF>
                                                </metadata>
                                                <defs id=\"defs6\">
                                                    <linearGradient x1=\"31.7997\" y1=\"183.2903\" x2=\"15.0173\"
                                                                    y2=\"166.5079\" gradientUnits=\"userSpaceOnUse\"
                                                                    gradientTransform=\"matrix(0.8,0,0,-0.8,0,161.6)\"
                                                                    spreadMethod=\"pad\" id=\"linearGradient50\">
                                                        <stop style=\"stop-opacity:1;stop-color:#00a0ff\" offset=\"0\"
                                                              id=\"stop52\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00a1ff\" offset=\"0.0066\"
                                                              id=\"stop54\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00beff\" offset=\"0.2601\"
                                                              id=\"stop56\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00d2ff\" offset=\"0.5122\"
                                                              id=\"stop58\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00dfff\" offset=\"0.7604\"
                                                              id=\"stop60\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00e3ff\" offset=\"1\"
                                                              id=\"stop62\"/>
                                                    </linearGradient>
                                                    <linearGradient x1=\"43.8344\" y1=\"171.9986\" x2=\"19.637501\"
                                                                    y2=\"171.9986\" gradientUnits=\"userSpaceOnUse\"
                                                                    gradientTransform=\"matrix(0.8,0,0,-0.8,0,161.6)\"
                                                                    spreadMethod=\"pad\" id=\"linearGradient68\">
                                                        <stop style=\"stop-opacity:1;stop-color:#ffe000\" offset=\"0\"
                                                              id=\"stop70\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#ffbd00\" offset=\"0.4087\"
                                                              id=\"stop72\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#ffa500\" offset=\"0.7754\"
                                                              id=\"stop74\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#ff9c00\" offset=\"1\"
                                                              id=\"stop76\"/>
                                                    </linearGradient>
                                                    <linearGradient x1=\"34.827\" y1=\"169.7039\" x2=\"12.0687\" y2=\"146.9456\"
                                                                    gradientUnits=\"userSpaceOnUse\"
                                                                    gradientTransform=\"matrix(0.8,0,0,-0.8,0,161.6)\"
                                                                    spreadMethod=\"pad\" id=\"linearGradient82\">
                                                        <stop style=\"stop-opacity:1;stop-color:#ff3a44\" offset=\"0\"
                                                              id=\"stop84\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#c31162\" offset=\"1\"
                                                              id=\"stop86\"/>
                                                    </linearGradient>
                                                    <linearGradient x1=\"17.2973\" y1=\"191.82381\" x2=\"27.4599\"
                                                                    y2=\"181.6613\" gradientUnits=\"userSpaceOnUse\"
                                                                    gradientTransform=\"matrix(0.8,0,0,-0.8,0,161.6)\"
                                                                    spreadMethod=\"pad\" id=\"linearGradient92\">
                                                        <stop style=\"stop-opacity:1;stop-color:#32a071\" offset=\"0\"
                                                              id=\"stop94\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#2da771\" offset=\"0.0685\"
                                                              id=\"stop96\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#15cf74\" offset=\"0.4762\"
                                                              id=\"stop98\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#06e775\" offset=\"0.8009\"
                                                              id=\"stop100\"/>
                                                        <stop style=\"stop-opacity:1;stop-color:#00f076\" offset=\"1\"
                                                              id=\"stop102\"/>
                                                    </linearGradient>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath110\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path112\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <mask maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"1\" height=\"1\"
                                                          id=\"mask114\">
                                                        <g id=\"g116\">
                                                            <g clip-path=\"url(#clipPath110)\" id=\"g118\">
                                                                <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                      style=\"fill:#000000;fill-opacity:0.2;fill-rule:nonzero;stroke:none\"
                                                                      id=\"path120\" inkscape:connector-curvature=\"0\"/>
                                                            </g>
                                                        </g>
                                                    </mask>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath126\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path128\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath130\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path132\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <pattern patternTransform=\"matrix(1,0,0,-1,0,48)\"
                                                             patternUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"124\"
                                                             height=\"48\" id=\"pattern134\">
                                                        <g id=\"g136\"/>
                                                        <g id=\"g138\">
                                                            <g clip-path=\"url(#clipPath130)\" id=\"g140\">
                                                                <g id=\"g142\">
                                                                    <path d=\"M 29.625,20.695 18.012,14.098 C 17.363,13.727 16.781,13.754 16.406,14.09 l -0.058,-0.063 0.058,-0.058 c 0.375,-0.336 0.957,-0.36 1.606,0.011 l 11.687,6.641 -0.074,0.074 z\"
                                                                          style=\"fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                          id=\"path144\"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </pattern>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath158\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path160\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <mask maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"1\" height=\"1\"
                                                          id=\"mask162\">
                                                        <g id=\"g164\">
                                                            <g clip-path=\"url(#clipPath158)\" id=\"g166\">
                                                                <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                      style=\"fill:#000000;fill-opacity:0.12000002;fill-rule:nonzero;stroke:none\"
                                                                      id=\"path168\" inkscape:connector-curvature=\"0\"/>
                                                            </g>
                                                        </g>
                                                    </mask>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath174\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path176\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath178\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path180\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <pattern patternTransform=\"matrix(1,0,0,-1,0,48)\"
                                                             patternUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"124\"
                                                             height=\"48\" id=\"pattern182\">
                                                        <g id=\"g184\"/>
                                                        <g id=\"g186\">
                                                            <g clip-path=\"url(#clipPath178)\" id=\"g188\">
                                                                <g id=\"g190\">
                                                                    <path d=\"m 16.348,14.145 c -0.235,0.246 -0.371,0.628 -0.371,1.125 l 0,-0.118 c 0,-0.496 0.136,-0.879 0.371,-1.125 l 0.058,0.063 -0.058,0.055 z\"
                                                                          style=\"fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                          id=\"path192\"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </pattern>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath206\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path208\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <mask maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"1\" height=\"1\"
                                                          id=\"mask210\">
                                                        <g id=\"g212\">
                                                            <g clip-path=\"url(#clipPath206)\" id=\"g214\">
                                                                <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                      style=\"fill:#000000;fill-opacity:0.12000002;fill-rule:nonzero;stroke:none\"
                                                                      id=\"path216\" inkscape:connector-curvature=\"0\"/>
                                                            </g>
                                                        </g>
                                                    </mask>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath222\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path224\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath226\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path228\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <pattern patternTransform=\"matrix(1,0,0,-1,0,48)\"
                                                             patternUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"124\"
                                                             height=\"48\" id=\"pattern230\">
                                                        <g id=\"g232\"/>
                                                        <g id=\"g234\">
                                                            <g clip-path=\"url(#clipPath226)\" id=\"g236\">
                                                                <g id=\"g238\">
                                                                    <path d=\"m 33.613,22.961 -3.988,-2.266 0.074,-0.074 3.914,2.223 c 0.559,0.316 0.836,0.734 0.836,1.156 -0.047,-0.379 -0.332,-0.75 -0.836,-1.039 z\"
                                                                          style=\"fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                          id=\"path240\"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </pattern>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath254\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path256\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <mask maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"1\" height=\"1\"
                                                          id=\"mask258\">
                                                        <g id=\"g260\">
                                                            <g clip-path=\"url(#clipPath254)\" id=\"g262\">
                                                                <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                      style=\"fill:#000000;fill-opacity:0.25;fill-rule:nonzero;stroke:none\"
                                                                      id=\"path264\" inkscape:connector-curvature=\"0\"/>
                                                            </g>
                                                        </g>
                                                    </mask>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath270\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path272\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <clipPath clipPathUnits=\"userSpaceOnUse\" id=\"clipPath274\">
                                                        <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\" id=\"path276\"
                                                              inkscape:connector-curvature=\"0\"/>
                                                    </clipPath>
                                                    <pattern patternTransform=\"matrix(1,0,0,-1,0,48)\"
                                                             patternUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"124\"
                                                             height=\"48\" id=\"pattern278\">
                                                        <g id=\"g280\"/>
                                                        <g id=\"g282\">
                                                            <g clip-path=\"url(#clipPath274)\" id=\"g284\">
                                                                <g id=\"g286\">
                                                                    <path d=\"m 18.012,33.902 15.601,-8.863 c 0.508,-0.289 0.789,-0.66 0.836,-1.039 0,0.418 -0.277,0.836 -0.836,1.156 L 18.012,34.02 c -1.117,0.632 -2.035,0.105 -2.035,-1.176 l 0,-0.114 c 0,1.278 0.918,1.805 2.035,1.172 z\"
                                                                          style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                          id=\"path288\"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </pattern>
                                                </defs>
                                                <sodipodi:namedview pagecolor=\"#ffffff\" bordercolor=\"#666666\"
                                                                    borderopacity=\"1\" objecttolerance=\"10\"
                                                                    gridtolerance=\"10\" guidetolerance=\"10\"
                                                                    inkscape:pageopacity=\"0\" inkscape:pageshadow=\"2\"
                                                                    inkscape:window-width=\"1366\"
                                                                    inkscape:window-height=\"705\" id=\"namedview4\"
                                                                    showgrid=\"false\" inkscape:zoom=\"7.6276974\"
                                                                    inkscape:cx=\"93.965168\" inkscape:cy=\"29.61582\"
                                                                    inkscape:window-x=\"-8\" inkscape:window-y=\"-8\"
                                                                    inkscape:window-maximized=\"1\"
                                                                    inkscape:current-layer=\"g10\"/>
                                                <g id=\"g10\" inkscape:groupmode=\"layer\"
                                                   inkscape:label=\"google-play-badge\"
                                                   transform=\"matrix(1.25,0,0,-1.25,-9.4247625,49.85025)\">
                                                    <g id=\"g12\"
                                                       transform=\"matrix(1.0023923,0,0,0.99072975,-0.29664807,0)\">
                                                        <path d=\"M 112,8 12,8 C 9.801,8 8,9.801 8,12 l 0,24 c 0,2.199 1.801,4 4,4 l 100,0 c 2.199,0 4,-1.801 4,-4 l 0,-24 c 0,-2.199 -1.801,-4 -4,-4 z\"
                                                              style=\"fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                              id=\"path14\" inkscape:connector-curvature=\"0\"/>
                                                        <path d=\"m 112,39.359 c 1.852,0 3.359,-1.507 3.359,-3.359 l 0,-24 c 0,-1.852 -1.507,-3.359 -3.359,-3.359 l -100,0 c -1.852,0 -3.359,1.507 -3.359,3.359 l 0,24 c 0,1.852 1.507,3.359 3.359,3.359 l 100,0 M 112,40 12,40 C 9.801,40 8,38.199 8,36 L 8,12 C 8,9.801 9.801,8 12,8 l 100,0 c 2.199,0 4,1.801 4,4 l 0,24 c 0,2.199 -1.801,4 -4,4 z\"
                                                              style=\"fill:#a6a6a6;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                              id=\"path16\" inkscape:connector-curvature=\"0\"/>
                                                        <g id=\"g18\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 45.934,16.195 c 0,0.668 -0.2,1.203 -0.594,1.602 -0.453,0.473 -1.043,0.711 -1.766,0.711 -0.691,0 -1.281,-0.242 -1.765,-0.719 -0.485,-0.484 -0.727,-1.078 -0.727,-1.789 0,-0.711 0.242,-1.305 0.727,-1.785 0.484,-0.481 1.074,-0.723 1.765,-0.723 0.344,0 0.672,0.071 0.985,0.203 0.312,0.133 0.566,0.313 0.75,0.535 l -0.418,0.422 c -0.321,-0.379 -0.758,-0.566 -1.317,-0.566 -0.504,0 -0.941,0.176 -1.312,0.531 -0.367,0.356 -0.551,0.817 -0.551,1.383 0,0.566 0.184,1.031 0.551,1.387 0.371,0.351 0.808,0.531 1.312,0.531 0.535,0 0.985,-0.18 1.34,-0.535 0.234,-0.235 0.367,-0.559 0.402,-0.973 l -1.742,0 0,-0.578 2.324,0 c 0.028,0.125 0.036,0.246 0.036,0.363 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path20\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g22\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 49.621,14.191 -2.183,0 0,1.52 1.968,0 0,0.578 -1.968,0 0,1.52 2.183,0 0,0.589 -2.801,0 0,-4.796 2.801,0 0,0.589 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path24\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g26\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 52.223,18.398 -0.618,0 0,-4.207 -1.339,0 0,-0.589 3.297,0 0,0.589 -1.34,0 0,4.207 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path28\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g30\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 55.949,18.398 0,-4.796 0.617,0 0,4.796 -0.617,0 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path32\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g34\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 59.301,18.398 -0.613,0 0,-4.207 -1.344,0 0,-0.589 3.301,0 0,0.589 -1.344,0 0,4.207 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path36\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g38\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 66.887,17.781 c -0.473,0.485 -1.059,0.727 -1.758,0.727 -0.703,0 -1.289,-0.242 -1.762,-0.727 C 62.895,17.297 62.66,16.703 62.66,16 c 0,-0.703 0.235,-1.297 0.707,-1.781 0.473,-0.485 1.059,-0.727 1.762,-0.727 0.695,0 1.281,0.242 1.754,0.731 0.476,0.488 0.711,1.078 0.711,1.777 0,0.703 -0.235,1.297 -0.707,1.781 z m -3.063,-0.402 c 0.356,0.359 0.789,0.539 1.305,0.539 0.512,0 0.949,-0.18 1.301,-0.539 0.355,-0.359 0.535,-0.82 0.535,-1.379 0,-0.559 -0.18,-1.02 -0.535,-1.379 -0.352,-0.359 -0.789,-0.539 -1.301,-0.539 -0.516,0 -0.949,0.18 -1.305,0.539 -0.355,0.359 -0.535,0.82 -0.535,1.379 0,0.559 0.18,1.02 0.535,1.379 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path40\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g42\" transform=\"matrix(1,0,0,-1,0,48)\">
                                                            <path d=\"m 68.461,18.398 0,-4.796 0.75,0 2.332,3.73 0.027,0 -0.027,-0.922 0,-2.808 0.617,0 0,4.796 -0.644,0 -2.442,-3.914 -0.027,0 0.027,0.926 0,2.988 -0.613,0 z\"
                                                                  style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0.16;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1\"
                                                                  id=\"path44\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <path d=\"m 62.508,22.598 c -1.879,0 -3.414,-1.43 -3.414,-3.403 0,-1.957 1.535,-3.402 3.414,-3.402 1.883,0 3.418,1.445 3.418,3.402 0,1.973 -1.535,3.403 -3.418,3.403 z m 0,-5.465 c -1.031,0 -1.918,0.851 -1.918,2.062 0,1.227 0.887,2.063 1.918,2.063 1.031,0 1.922,-0.836 1.922,-2.063 0,-1.211 -0.891,-2.062 -1.922,-2.062 z m -7.449,5.465 c -1.883,0 -3.414,-1.43 -3.414,-3.403 0,-1.957 1.531,-3.402 3.414,-3.402 1.882,0 3.414,1.445 3.414,3.402 0,1.973 -1.532,3.403 -3.414,3.403 z m 0,-5.465 c -1.032,0 -1.922,0.851 -1.922,2.062 0,1.227 0.89,2.063 1.922,2.063 1.031,0 1.918,-0.836 1.918,-2.063 0,-1.211 -0.887,-2.062 -1.918,-2.062 z m -8.864,4.422 0,-1.446 3.453,0 c -0.101,-0.808 -0.371,-1.402 -0.785,-1.816 -0.504,-0.5 -1.289,-1.055 -2.668,-1.055 -2.125,0 -3.789,1.715 -3.789,3.84 0,2.125 1.664,3.84 3.789,3.84 1.149,0 1.985,-0.449 2.602,-1.031 l 1.019,1.019 c -0.863,0.824 -2.011,1.457 -3.621,1.457 -2.914,0 -5.363,-2.371 -5.363,-5.285 0,-2.914 2.449,-5.285 5.363,-5.285 1.575,0 2.758,0.516 3.688,1.484 0.953,0.953 1.25,2.293 1.25,3.375 0,0.336 -0.028,0.645 -0.078,0.903 l -4.86,0 z m 36.246,-1.121 c -0.281,0.761 -1.148,2.164 -2.914,2.164 -1.75,0 -3.207,-1.379 -3.207,-3.403 0,-1.906 1.442,-3.402 3.375,-3.402 1.563,0 2.465,0.953 2.836,1.508 l -1.16,0.773 c -0.387,-0.566 -0.914,-0.941 -1.676,-0.941 -0.757,0 -1.3,0.347 -1.648,1.031 l 4.551,1.883 -0.157,0.387 z m -4.64,-1.133 c -0.039,1.312 1.019,1.984 1.777,1.984 0.594,0 1.098,-0.297 1.266,-0.722 L 77.801,19.301 Z M 74.102,16 l 1.496,0 0,10 -1.496,0 0,-10 z m -2.45,5.84 -0.05,0 c -0.336,0.398 -0.977,0.758 -1.789,0.758 -1.704,0 -3.262,-1.496 -3.262,-3.414 0,-1.907 1.558,-3.391 3.262,-3.391 0.812,0 1.453,0.363 1.789,0.773 l 0.05,0 0,-0.488 c 0,-1.301 -0.695,-2 -1.816,-2 -0.914,0 -1.481,0.66 -1.715,1.215 L 66.82,14.75 c 0.375,-0.902 1.368,-2.012 3.016,-2.012 1.754,0 3.234,1.032 3.234,3.543 l 0,6.11 -1.418,0 0,-0.551 z m -1.711,-4.707 c -1.031,0 -1.894,0.863 -1.894,2.051 0,1.199 0.863,2.074 1.894,2.074 1.016,0 1.817,-0.875 1.817,-2.074 0,-1.188 -0.801,-2.051 -1.817,-2.051 z M 89.445,26 l -3.578,0 0,-10 1.492,0 0,3.789 2.086,0 c 1.657,0 3.282,1.199 3.282,3.106 0,1.906 -1.629,3.105 -3.282,3.105 z m 0.039,-4.82 -2.125,0 0,3.429 2.125,0 c 1.114,0 1.75,-0.925 1.75,-1.714 0,-0.774 -0.636,-1.715 -1.75,-1.715 z m 9.223,1.437 c -1.078,0 -2.199,-0.476 -2.66,-1.531 l 1.324,-0.555 c 0.285,0.555 0.809,0.735 1.363,0.735 0.774,0 1.559,-0.465 1.571,-1.286 l 0,-0.105 c -0.27,0.156 -0.848,0.387 -1.559,0.387 -1.426,0 -2.879,-0.785 -2.879,-2.25 0,-1.34 1.168,-2.203 2.481,-2.203 1.004,0 1.558,0.453 1.906,0.98 l 0.051,0 0,-0.773 1.441,0 0,3.836 c 0,1.773 -1.324,2.765 -3.039,2.765 z m -0.18,-5.48 c -0.488,0 -1.168,0.242 -1.168,0.847 0,0.774 0.848,1.071 1.582,1.071 0.657,0 0.965,-0.145 1.364,-0.336 -0.117,-0.926 -0.914,-1.582 -1.778,-1.582 z m 8.469,5.261 -1.715,-4.335 -0.051,0 -1.773,4.335 -1.609,0 2.664,-6.058 -1.52,-3.371 1.559,0 4.105,9.429 -1.66,0 z M 93.547,16 l 1.496,0 0,10 -1.496,0 0,-10 z\"
                                                              style=\"fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                              id=\"path46\" inkscape:connector-curvature=\"0\"/>
                                                        <g id=\"g48\">
                                                            <path d=\"M 16.348,33.969 C 16.113,33.723 15.977,33.34 15.977,32.844 l 0,-17.692 c 0,-0.496 0.136,-0.879 0.371,-1.125 l 0.058,-0.054 9.914,9.91 0,0.234 -9.914,9.91 -0.058,-0.058 z\"
                                                                  style=\"fill:url(#linearGradient50);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                  id=\"path64\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g66\">
                                                            <path d=\"m 29.621,20.578 -3.301,3.305 0,0.234 3.305,3.305 0.074,-0.043 3.914,-2.227 c 1.117,-0.632 1.117,-1.672 0,-2.308 l -3.914,-2.223 -0.078,-0.043 z\"
                                                                  style=\"fill:url(#linearGradient68);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                  id=\"path78\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g80\">
                                                            <path d=\"M 29.699,20.621 26.32,24 16.348,14.027 c 0.371,-0.39 0.976,-0.437 1.664,-0.047 l 11.687,6.641\"
                                                                  style=\"fill:url(#linearGradient82);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                  id=\"path88\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g90\">
                                                            <path d=\"M 29.699,27.379 18.012,34.02 c -0.688,0.386 -1.293,0.339 -1.664,-0.051 L 26.32,24 l 3.379,3.379 z\"
                                                                  style=\"fill:url(#linearGradient92);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                  id=\"path104\" inkscape:connector-curvature=\"0\"/>
                                                        </g>
                                                        <g id=\"g106\">
                                                            <g id=\"g108\"/>
                                                            <g id=\"g122\" mask=\"url(#mask114)\">
                                                                <g id=\"g124\"/>
                                                                <g id=\"g146\">
                                                                    <g clip-path=\"url(#clipPath126)\" id=\"g148\">
                                                                        <g id=\"g150\">
                                                                            <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                                  style=\"fill:url(#pattern134);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                                  id=\"path152\"
                                                                                  inkscape:connector-curvature=\"0\"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id=\"g154\">
                                                            <g id=\"g156\"/>
                                                            <g id=\"g170\" mask=\"url(#mask162)\">
                                                                <g id=\"g172\"/>
                                                                <g id=\"g194\">
                                                                    <g clip-path=\"url(#clipPath174)\" id=\"g196\">
                                                                        <g id=\"g198\">
                                                                            <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                                  style=\"fill:url(#pattern182);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                                  id=\"path200\"
                                                                                  inkscape:connector-curvature=\"0\"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id=\"g202\">
                                                            <g id=\"g204\"/>
                                                            <g id=\"g218\" mask=\"url(#mask210)\">
                                                                <g id=\"g220\"/>
                                                                <g id=\"g242\">
                                                                    <g clip-path=\"url(#clipPath222)\" id=\"g244\">
                                                                        <g id=\"g246\">
                                                                            <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                                  style=\"fill:url(#pattern230);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                                  id=\"path248\"
                                                                                  inkscape:connector-curvature=\"0\"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id=\"g250\">
                                                            <g id=\"g252\"/>
                                                            <g id=\"g266\" mask=\"url(#mask258)\">
                                                                <g id=\"g268\"/>
                                                                <g id=\"g290\">
                                                                    <g clip-path=\"url(#clipPath270)\" id=\"g292\">
                                                                        <g id=\"g294\">
                                                                            <path d=\"M 0,0 124,0 124,48 0,48 0,0 Z\"
                                                                                  style=\"fill:url(#pattern278);fill-opacity:1;fill-rule:nonzero;stroke:none\"
                                                                                  id=\"path296\"
                                                                                  inkscape:connector-curvature=\"0\"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g></svg>
                                        </a>
                                    </p>
                                </div>

                            </li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Demandez à vos directeurs de succursale/magasin de scanner les CV - cela les rendent inexpirables</li>"
        ]
    ],
    
    'career' => [
        'title' => "Lien vers votre page carrière",
        'time' => "1 minute",
        'link_1' => "Copier le lien",
        'link_2' => "Ajoutez-le partout",
        'link_3' => "Rassembler des candidats Actifs",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "En ajoutant le lien à vos offres d'emploi, sites web, publications sociales, vous recevrez que des candidats actifs."
        ],
        'hint' => "Cela nécessite parfois l'aide votre administrateur informatique",
        'text_box_2' => [
            'title' => "Étapes pour intégrerSteps to integrate",
            'text' => "<li>À partir du lien de la page Carrière à gauche, sélectionnez le lien et copiez-le au besoin.<button class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</button></li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Demandez à vos directeurs de succursale/magasin de scanner les CV - cela les rendra inexpirables</li>"
        ]
    ],
    
    'boards' => [
        'title' => "<p class=\"mb-1 text text-center fw-lighter\" style=\"font-size:30px;\">Bénéficiez d'un ROI extrême en postant sur des sites d'emploi</p>
                <p class=\"mb-5 text text-center fw-lighter\" style=\"font-size:30px;\">Fonctionne avec 200+ sites Web de sites d'emploi populaires</p>",
        'time' => "1 minute",
        'link_1' => "Copier le lien",
        'link_2' => "Ajoutez-le partout sur une annonce",
        'link_3' => "Rassembler des candidats actifs",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "En ajoutant un lien CR, vous garderez pour toujours les candidats qui verront vos messages sur les sites d'emploi. Cela améliore grandement le ROI de chaque offre d'emploi."
        ],
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Depuis votre lien CR sur la gauche, sélectionnez le lien et copiez-le si nécessaire.<button class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</button></li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">En ajoutant le lien vers le haut ou le bas de votre offre d'emploi et en demandant à vos candidats d'y postuler, vous les rendez inexpirables.</li>"
        ]
    ],
    
    'social' => [
        'title' => "<p class=\"mb-1 text text-center fw-lighter\" style=\"font-size:30px;\">Annonce Médias Sociaux</p>
                <p class=\"mb-5 text text-center fw-lighter\" style=\"font-size:30px;\">CR Link</p>",
        'time' => "Moins d'une minute",
        'link_1' => "Copier le lien",
        'link_2' => "Ajoutez à n'importe quel post social",
        'link_3' => "Rassembler des candidats actifs",
        'text_box_1' => [
            'title' => "Comment ça marche",
            'text' => "En ajoutant un lien CR à vos publications sur les réseaux sociaux, tous les candidats deviendront inexpirables."
        ],
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Dans le menu Social Posts, copiez le lien CR et collez-le dans un post de réseau social<button class=\"btn btn-primary btn-sm ml-3 mxa-0\">:button</button></li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Ajouter le lien à votre offre d'emploi sur les médias sociaux rendra les candidats actifs.</li>"
        ]
    ],
    
    'posting' => [
        'title' => "<p class=\"mb-1 text text-center fw-lighter\" style=\"font-size:30px;\">Offres <span style=\"font-size: 50px;\">gratuit</span> d'emploi illimité sur JobMap</p>
                <p class=\"mb-5 text text-center fw-lighter\" style=\"font-size:30px;\">Utilisez l'outil de géolocalisation pour attirer des talents locaux</p>",
        'time' => "Cela dépend de vos besoins d'embauche",
        'link_1' => "Ajouter des emplacements",
        'link_2' => "Ajouter des emplois",
        'link_3' => "Rassembler des candidats actifs",
        'hint' => "Sur le plan gratuit, vous pouvez renouveler un nombre illimité d'emplois manuellement.<br>
								Ajuster votre plan pour que la fonction de renouvellement automatique d'emploi s'active.",
        'text_box_1' => [
          'title' => "Comment ça marche",
          'text' => "JobMap géolocalise vos emplacements. Les candidats à proximité peuvent voir les emplois disponibles dans chaque emplacement et trouver votre entreprise sur le moteur de recherche JobMap."
        ],
        'text_box_2' => [
            'title' => "Étapes pour intégrer",
            'text' => "<li>Créez votre premier emplacement même si vous en avez plusieurs<button class=\"btn btn-primary btn-sm ml-3\">:button</button></li>
		                	<li class=\"mt-3\">Créez vos emplois et attribuez-les aux emplacements<button class=\"btn btn-primary btn-sm ml-3\">:button</button></li>"
        ],
        'text_box_3' => [
            'title' => "Meilleures pratiques",
            'text' => "<li class=\"mt-2\">Il est gratuit d'ajouter un nombre illimités d'emplois sur JobMap</li>
                	<li class=\"mt-2\">N'oubliez pas que même si aucun emploi n'est activé, vous pouvez toujours recevoir des candidats.</li>
                	<li class=\"mt-2\">L'ajout de tous vos emplois disponibles, même s'ils sont fermés, augmentera vos chances d'obtenir des candidats</li>
                	<li class=\"mt-2\">L'ajout de toutes vos succursales augmente vos chances de recevoir des candidats locaux autour d'emplacements spécifiques.</li>
                	<li class=\"mt-2\">Assurez-vous d'avoir le bon logo pour votre entreprise afin que votre entreprise s'affiche correctement sur JobMap</li>"
        ]
    ],
    
    
];
