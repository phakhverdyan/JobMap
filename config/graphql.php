<?php


return [
    /*
     * The prefix for routes
     */
    'prefix' => 'graphql',

    /*
     * The routes to make GraphQL request. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Route
     *
     * Example:
     *
     * Same route for both query and mutation
     *
     * 'routes' => [
     *     'query' => 'query/{graphql_schema?}',
     *     'mutation' => 'mutation/{graphql_schema?}',
     *      mutation' => 'graphiql'
     * ]
     *
     * you can also disable routes by setting routes to null
     *
     * 'routes' => null,
     */
    'routes' => '{graphql_schema?}',

    /*
     * The controller to use in GraphQL requests. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Controller and method
     *
     * Example:
     *
     * 'controllers' => [
     *     'query' => '\Folklore\GraphQL\GraphQLController@query',
     *     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
     * ]
     */
    'controllers' => \Folklore\GraphQL\GraphQLController::class . '@query',

    /*
     * The name of the input variable that contain variables when you query the
     * endpoint. Most libraries use "variables", you can change it here in case you need it.
     * In previous versions, the default used to be "params"
     */
    'variables_input_name' => 'variables',

    /*
     * Any middleware for the 'graphql' route group
     */
    'middleware' => ['graph'],

    /**
     * Any middleware for a specific 'graphql' schema
     */
    'middleware_schema' => [
        'default' => [],
    ],

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,

    /*
     * Available locals
     */
    'available_locales' => ['en', 'fr'],

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     * To dissable GraphiQL, set this to null
     */
    'graphiql' => [
        'routes' => '/graphiql/{graphql_schema?}',
        'controller' => \Folklore\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'composer' => \Folklore\GraphQL\View\GraphiQLComposer::class,
    ],

    /*
     * The name of the default schema used when no arguments are provided
     * to GraphQL::schema() or when the route is used without the graphql_schema
     * parameter
     */
    'schema' => 'default',

    /*
     * The schemas for query and/or mutation. It expects an array to provide
     * both the 'query' fields and the 'mutation' fields. You can also
     * provide an GraphQL\Schema object directly.
     *
     * Example:
     *
     * 'schemas' => [
     *     'default' => new Schema($config)
     * ]
     *
     * or
     *
     * 'schemas' => [
     *     'default' => [
     *         'query' => [
     *              'users' => 'App\GraphQL\Query\UsersQuery'
     *          ],
     *          'mutation' => [
     *
     *          ]
     *     ]
     * ]
     */
    'schemas' => [
        'default' => [
            'query' => [
                'api' => 'App\GraphQL\Query\ApiQuery',
                'logout' => 'App\GraphQL\Query\User\Auth\LogoutQuery',
                'login' => 'App\GraphQL\Query\User\LoginQuery',
                'loginSocial' => 'App\GraphQL\Query\User\LoginSocialQuery',
                'me' => 'App\GraphQL\Query\User\Auth\UserQuery',
                'resume' => 'App\GraphQL\Query\User\Auth\ResumeQuery',
                'printBuilder' => 'App\GraphQL\Query\User\Auth\PrintBuilderQuery',
                'profile' => 'App\GraphQL\Query\User\ProfileQuery',
                'sentResume' => 'App\GraphQL\Query\User\Auth\SentQuery',

                'sendClaimUBis' => 'App\GraphQL\Query\SendClaimUncBusinessQuery',

                'loadPrintBuilderSelection' => 'App\GraphQL\Query\User\Auth\LoadPrintBuilderSelectionQuery',

                'autocompleteResume' => 'App\GraphQL\Query\User\AutocompleteResumeQuery',

                'resetPassword' => 'App\GraphQL\Query\User\ResetPasswordQuery',

                'pipeline' => 'App\GraphQL\Query\User\Business\Auth\PipelineQuery',
                'pipelineItem' => 'App\GraphQL\Query\User\Business\Auth\PipelineItemQuery',
                'candidateOverview' => 'App\GraphQL\Query\User\Business\Auth\CandidateOverviewQuery',
                'business' => 'App\GraphQL\Query\User\Business\BusinessQuery',
                'businesses' => 'App\GraphQL\Query\User\Business\Auth\BusinessesQuery',
                'businessesSearch' => 'App\GraphQL\Query\User\Business\BusinessesSearchQuery',
                'businessesAll' => 'App\GraphQL\Query\BusinessesQuery',
                'businessBrands' => 'App\GraphQL\Query\User\Business\BrandsQuery',
                'businessBrandsAll' => 'App\GraphQL\Query\User\Business\BrandsAllQuery',
                'businessBrandsAuth' => 'App\GraphQL\Query\User\Business\Auth\BrandsQuery',
                'businessLocation' => 'App\GraphQL\Query\User\Business\LocationQuery',
                'businessLocations' => 'App\GraphQL\Query\User\Business\LocationsQuery',
                'businessLocationsBrands' => 'App\GraphQL\Query\User\Business\Auth\BusinessLocationsBrandsQuery',
                'businessDepartment' => 'App\GraphQL\Query\User\Business\DepartmentQuery',
                'businessDepartments' => 'App\GraphQL\Query\User\Business\DepartmentsQuery',
                'businessCandidates' => 'App\GraphQL\Query\User\Business\Auth\CandidatesQuery',
                'businessCandidate' => 'App\GraphQL\Query\User\Business\Auth\CandidateQuery',
                'businessManagers' => 'App\GraphQL\Query\User\Business\Auth\ManagersQuery',
                'businessManager' => 'App\GraphQL\Query\User\Business\Auth\ManagerQuery',
                'businessJobs' => 'App\GraphQL\Query\User\Business\JobsQuery',
                'allBusinessJobs' => 'App\GraphQL\Query\User\Business\AllJobsQuery',
                'businessJobsLocations' => 'App\GraphQL\Query\User\Business\Auth\JobsLocationsQuery',
                'brandsJobs' => 'App\GraphQL\Query\User\Business\JobsBrandsQuery',
                'businessJob' => 'App\GraphQL\Query\User\Business\JobQuery',
                'businessWebsiteButtons' => 'App\GraphQL\Query\User\Business\WebsiteButtonsQuery',
                'businessWebsiteButton' => 'App\GraphQL\Query\User\Business\WebsiteButtonQuery',

                'businessWebsiteWidgets' => 'App\GraphQL\Query\User\Business\WebsiteWidgetsQuery',
                'businessWebsiteWidget' => 'App\GraphQL\Query\User\Business\WebsiteWidgetQuery',
                'businessWidgetUploadBgImage' => 'App\GraphQL\Query\User\Business\WidgetUploadBgImageQuery',

                'businessUnconfirmed' => 'App\GraphQL\Query\BusinessUnconfirmedQuery',

                'questionsJob' => 'App\GraphQL\Query\User\Business\Auth\QuestionsJobQuery',

                'inviteInfo' => 'App\GraphQL\Query\InviteInfoQuery',
                'languages' => 'App\GraphQL\Query\LanguagesQuery',
                'geo' => 'App\GraphQL\Query\GeoQuery',
                'geoStreet' => 'App\GraphQL\Query\GeoStreetQuery',
                'sizes' => 'App\GraphQL\Query\BusinessSizesQuery',
                'amenities' => 'App\GraphQL\Query\AmenitiesQuery',
                'jobTypes' => 'App\GraphQL\Query\JobTypesQuery',
                'keywords' => 'App\GraphQL\Query\KeywordsQuery',
                'mapKeywords' => 'App\GraphQL\Query\MapKeywordsQuery',
                'certificates' => 'App\GraphQL\Query\CertificatesQuery',
                'careerLevels' => 'App\GraphQL\Query\CareerLevelsQuery',
                'categories' => 'App\GraphQL\Query\CategoriesQuery',
                'jobCategories' => 'App\GraphQL\Query\JobCategoriesQuery',
                'industries' => 'App\GraphQL\Query\IndustriesQuery',
                'industryCategories' => 'App\GraphQL\Query\IndustryCategoriesQuery',
                'worldLanguages' => 'App\GraphQL\Query\WorldLanguagesQuery',

                'keywordsByLocation' => 'App\GraphQL\Query\User\Business\KeywordsByLocationQuery',
                'locationsKeywords' => 'App\GraphQL\Query\User\Business\LocationsKeywordsQuery',
                'locationsSearch' => 'App\GraphQL\Query\User\Business\LocationsSearchQuery',
                'locations' => 'App\GraphQL\Query\User\Business\MapLocationsListQuery',
                'locationsUnconfirmed' => 'App\GraphQL\Query\User\Business\MapLocationsUnconfirmedListQuery',
                'location' => 'App\GraphQL\Query\User\Business\MapLocationQuery',
                'locationUnconfirmed' => 'App\GraphQL\Query\User\Business\MapLocationUnconfirmedQuery',
                'nearbyLocations' => 'App\GraphQL\Query\User\Business\NearbyLocationsQuery',
                'nearbyJobs' => 'App\GraphQL\Query\User\Business\NearbyJobsQuery',
                'jobUnion' => 'App\GraphQL\Query\User\Business\JobUnionQuery',
                'map' => 'App\GraphQL\Query\User\Business\MapLocationsQuery',
                'searchEmployers' => 'App\GraphQL\Query\User\Business\SearchEmployersQuery',
                'searchJobs' => 'App\GraphQL\Query\User\Business\SearchJobsQuery',
                'mapJobs' => 'App\GraphQL\Query\User\Business\MapJobsQuery',
                'mapJob' => 'App\GraphQL\Query\User\Business\MapJobQuery',
                'locationInfo' => 'App\GraphQL\Query\User\Business\ByLocationInfoQuery',
                'mapBusinesses' => 'App\GraphQL\Query\User\Business\MapLocationItemsQuery',
                'card' => 'App\GraphQL\Query\User\Business\Auth\CardQuery',
                'cards' => 'App\GraphQL\Query\User\Business\Auth\CardsQuery',
                'monthlyPlan' => 'App\GraphQL\Query\MonthlyPlanQuery',
                'monthlyPlans' => 'App\GraphQL\Query\MonthlyPlansQuery',
                'businessMonthlyPlan' => 'App\GraphQL\Query\User\Business\Auth\CurrentMonthlyPlan',
                'checkCoupon' => 'App\GraphQL\Query\User\Business\Auth\DiscountQuery',
                'tax' => 'App\GraphQL\Query\TaxQuery',
                'invoice' => 'App\GraphQL\Query\User\Business\Auth\InvoiceQuery',
                'invoices' => 'App\GraphQL\Query\User\Business\Auth\InvoicesQuery',
                'billingAddress' => 'App\GraphQL\Query\User\Business\Auth\BillingAddressQuery',
                'bmic' => 'App\GraphQL\Query\User\Business\Auth\BmicQuery',

                'chats' => 'App\GraphQL\Query\User\Chat\ChatsQuery',
                // 'businessChats' => 'App\GraphQL\Query\User\Chat\BusinessChatsQuery',
                'chat' => 'App\GraphQL\Query\User\Chat\ChatQuery',
                'chatMessages' => 'App\GraphQL\Query\User\Chat\ChatMessagesQuery',
                'chatMessage' => 'App\GraphQL\Query\User\Chat\ChatMessageQuery',
                'chatInterlocutor' => 'App\GraphQL\Query\User\Chat\ChatInterlocutorQuery',
                'countOfUnreadChatMessages' => 'App\GraphQL\Query\User\Chat\CountOfUnreadChatMessagesQuery',
                'emitChatTyping' => 'App\GraphQL\Query\User\Chat\EmitChatTypingQuery',

                'interviewRequests' => 'App\GraphQL\Query\User\InterviewRequestsQuery',
                'countsOfInterviewRequests' => 'App\GraphQL\Query\User\CountsOfInterviewRequestsQuery',

                // 'getUsersOnline' => 'App\GraphQL\Query\User\Chat\ChatUsersOnlineQuery',

                'academy' => 'App\GraphQL\Query\User\AcademyQuery',
                'school' => 'App\GraphQL\Query\User\SchoolQuery',

                'references' => 'App\GraphQL\Query\User\Auth\ReferencesQuery',

                'notifyCounterBusiness' => 'App\GraphQL\Query\User\Business\Auth\NotifyCounterQuery',
                'notifyCounterLastDateUser' => 'App\GraphQL\Query\User\Auth\NotifyCounterLastDateQuery',

                'resendVerificationCode' => 'App\GraphQL\Query\User\Auth\ResendVerificationCodeQuery',

                'atsList'=> 'App\GraphQL\Query\User\Business\Auth\AtsListQuery',
                'resendInvitationATS'=> 'App\GraphQL\Query\User\Business\Auth\ResendInvitationQuery',
                'inviteATSInfo'=> 'App\GraphQL\Query\InviteATSInfoQuery',

                'letsGetStarted'=> 'App\GraphQL\Query\User\Business\Auth\LetsGetStartedQuery',
                'getHowToStartGotIt'=> 'App\GraphQL\Query\User\Business\Auth\GetHowToStartGotItQuery',

                'getJobsAutoComplete' => 'App\GraphQL\Query\User\Business\GetJobsAutoCompleteQuery',
                'getLocationsAutoComplete' => 'App\GraphQL\Query\User\Business\GetLocationsAutoCompleteQuery',

                'getDaysFromSendResume'=> 'App\GraphQL\Query\User\Business\Auth\GetDaysFromSendResumeQuery',

                'getPricingStrategy'=> 'App\GraphQL\Query\GetPricingStrategyQuery',

                'getUserForScanBusiness' => 'App\GraphQL\Query\User\Business\Auth\GetUserForScanBusinessQuery',
                'getUserForReference' => 'App\GraphQL\Query\User\GetUserForReferenceQuery',

                'getDataSearch' => 'App\GraphQL\Query\GetDataSearchQuery',
                'getCategoriesJobsSearch' => 'App\GraphQL\Query\GetCategoriesJobsSearchQuery',

                'sendCandidateData' => 'App\GraphQL\Query\User\Business\Auth\SendCandidateDataQuery',

                'widgetCheckInfo' => 'App\GraphQL\Query\User\Widget\CheckInfoQuery',
                'widgetUploadCV' => 'App\GraphQL\Query\User\Widget\UploadCVQuery',

            ],
            'mutation' => [
                'createUser' => 'App\GraphQL\Mutation\User\CreateMutation',
                'createCheck' => 'App\GraphQL\Mutation\User\CreateCheckMutation',
                'updateUser' => 'App\GraphQL\Mutation\User\UpdateMutation',

                'createUserNew' => 'App\GraphQL\Mutation\User\CreateNewMutation',
                'createUserCheckNew' => 'App\GraphQL\Mutation\User\CreateCheckNewMutation',
                'widgetUserCreate' => 'App\GraphQL\Mutation\User\Widget\CreateMutation',

                'createUserImport' => 'App\GraphQL\Mutation\User\CreateImportMutation',
                'updateUserImport' => 'App\GraphQL\Mutation\User\UpdateImportMutation',

                'createAdministratorFranchise' => 'App\GraphQL\Mutation\User\CreateAdministratorFranchiseMutation',

                'updateFieldRunFirst' => 'App\GraphQL\Mutation\User\UpdateFieldRunFirstMutation',

                'changePassword' => 'App\GraphQL\Mutation\User\ChangePasswordMutation',

                'changePass' => 'App\GraphQL\Mutation\User\Settings\ChangePassMutation',
                'changeEmail' => 'App\GraphQL\Mutation\User\Settings\ChangeEmailMutation',
                'setShowTooltip' => 'App\GraphQL\Mutation\User\Settings\SetShowTooltipMutation',

                'sendResume' => 'App\GraphQL\Mutation\User\Resume\SendMutation',

                'savePrintBuilderSelection' => 'App\GraphQL\Mutation\User\Resume\SavePrintBuilderSelectionMutation',
                'delPrintBuilderSelection' => 'App\GraphQL\Mutation\User\Resume\DelPrintBuilderSelectionMutation',

                'CreateCandidate' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\CreateMutation',
                'candidateNote' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\CreateNoteMutation',
                'deleteNote' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\DeleteNoteMutation',
                'candidateUpdatePipeline' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\UpdatePipelineMutation',
                'candidateClickedOn' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\UpdateClickedOnMutation',
                'resumeRequest' => 'App\GraphQL\Mutation\User\Business\Applicant\Candidate\UpdateRequestMutation',
                'resumeResponse' => 'App\GraphQL\Mutation\User\Resume\UpdateResponseMutation',

                'updateUserPreference' => 'App\GraphQL\Mutation\User\Resume\UpdatePreferenceMutation',
                'updateUserAvailability' => 'App\GraphQL\Mutation\User\Resume\UpdateAvailabilityMutation',
                'updateUserBasicInfo' => 'App\GraphQL\Mutation\User\Resume\UpdateBasicInfoMutation',
                'updateUserExperience' => 'App\GraphQL\Mutation\User\Resume\UpdateExperienceMutation',
                'updateUserEducation' => 'App\GraphQL\Mutation\User\Resume\UpdateEducationMutation',
                'updateUserCertification' => 'App\GraphQL\Mutation\User\Resume\UpdateCertificationMutation',

                'createEducation' => 'App\GraphQL\Mutation\User\Resume\Education\CreateMutation',
                'updateEducation' => 'App\GraphQL\Mutation\User\Resume\Education\UpdateMutation',
                'deleteEducation' => 'App\GraphQL\Mutation\User\Resume\Education\DeleteMutation',

                'createExperience' => 'App\GraphQL\Mutation\User\Resume\Experience\CreateMutation',
                'updateExperience' => 'App\GraphQL\Mutation\User\Resume\Experience\UpdateMutation',
                'deleteExperience' => 'App\GraphQL\Mutation\User\Resume\Experience\DeleteMutation',

                'createReference' => 'App\GraphQL\Mutation\User\Resume\Reference\CreateMutation',
                'updateReference' => 'App\GraphQL\Mutation\User\Resume\Reference\UpdateMutation',
                'resendReference' => 'App\GraphQL\Mutation\User\Resume\Reference\ResendMutation',
                'confirmedReference' => 'App\GraphQL\Mutation\User\Resume\Reference\ConfirmedMutation',
                'deleteReference' => 'App\GraphQL\Mutation\User\Resume\Reference\DeleteMutation',
                'sendReference' => 'App\GraphQL\Mutation\User\Resume\Reference\SendMutation',

                'createSkill' => 'App\GraphQL\Mutation\User\Resume\Skill\CreateMutation',
                'updateSkill' => 'App\GraphQL\Mutation\User\Resume\Skill\UpdateMutation',
                'deleteSkill' => 'App\GraphQL\Mutation\User\Resume\Skill\DeleteMutation',

                'createLanguage' => 'App\GraphQL\Mutation\User\Resume\Language\CreateMutation',
                'updateLanguage' => 'App\GraphQL\Mutation\User\Resume\Language\UpdateMutation',
                'deleteLanguage' => 'App\GraphQL\Mutation\User\Resume\Language\DeleteMutation',

                'createCertification' => 'App\GraphQL\Mutation\User\Resume\Certification\CreateMutation',
                'updateCertification' => 'App\GraphQL\Mutation\User\Resume\Certification\UpdateMutation',
                'deleteCertification' => 'App\GraphQL\Mutation\User\Resume\Certification\DeleteMutation',

                'createDistinction' => 'App\GraphQL\Mutation\User\Resume\Distinction\CreateMutation',
                'updateDistinction' => 'App\GraphQL\Mutation\User\Resume\Distinction\UpdateMutation',
                'deleteDistinction' => 'App\GraphQL\Mutation\User\Resume\Distinction\DeleteMutation',

                'createHobby' => 'App\GraphQL\Mutation\User\Resume\Hobby\CreateMutation',
                'updateHobby' => 'App\GraphQL\Mutation\User\Resume\Hobby\UpdateMutation',
                'deleteHobby' => 'App\GraphQL\Mutation\User\Resume\Hobby\DeleteMutation',

                'createInterest' => 'App\GraphQL\Mutation\User\Resume\Interest\CreateMutation',
                'updateInterest' => 'App\GraphQL\Mutation\User\Resume\Interest\UpdateMutation',
                'deleteInterest' => 'App\GraphQL\Mutation\User\Resume\Interest\DeleteMutation',

                'createBusiness' => 'App\GraphQL\Mutation\User\Business\CreateMutation',
                'updateBusiness' => 'App\GraphQL\Mutation\User\Business\UpdateMutation',
                'deleteBrand' => 'App\GraphQL\Mutation\User\Business\DeleteMutation',

                'updateBusinessSizeId' => 'App\GraphQL\Mutation\User\Business\UpdateBusinessSizeIdMutation',
                'updateImageBusiness' => 'App\GraphQL\Mutation\User\Business\UpdateImageBusinessMutation',
                'deleteImageBusiness' => 'App\GraphQL\Mutation\User\Business\DeleteImageBusinessMutation',
                'updateBusinessRunFirst' => 'App\GraphQL\Mutation\User\Business\UpdateBusinessRunFirstMutation',

                'createLocation' => 'App\GraphQL\Mutation\User\Business\Location\CreateMutation',
                'updateLocation' => 'App\GraphQL\Mutation\User\Business\Location\UpdateMutation',
                'updateImageLocation' => 'App\GraphQL\Mutation\User\Business\Location\UpdateImageLocationMutation',
                'updateLocationManager' => 'App\GraphQL\Mutation\User\Business\Location\UpdateManagerMutation',
                'updateJobLocationStatus' => 'App\GraphQL\Mutation\User\Business\Location\UpdateStatusesMutation',
                'deleteLocation' => 'App\GraphQL\Mutation\User\Business\Location\DeleteMutation',
                'uploadLocationsFromFile' => 'App\GraphQL\Mutation\User\Business\Location\UploadLocationsFromFileMutation',

                'createDepartment' => 'App\GraphQL\Mutation\User\Business\Department\CreateMutation',
                'updateDepartment' => 'App\GraphQL\Mutation\User\Business\Department\UpdateMutation',
                'updateDepartmentLocation' => 'App\GraphQL\Mutation\User\Business\Department\UpdateLocationMutation',
                'deleteDepartment' => 'App\GraphQL\Mutation\User\Business\Department\DeleteMutation',

                'createPipeline' => 'App\GraphQL\Mutation\User\Business\Applicant\Pipeline\CreateMutation',
                'updatePipeline' => 'App\GraphQL\Mutation\User\Business\Applicant\Pipeline\UpdateMutation',
                'updatePositionPipeline' => 'App\GraphQL\Mutation\User\Business\Applicant\Pipeline\UpdatePositionMutation',
                'deletePipeline' => 'App\GraphQL\Mutation\User\Business\Applicant\Pipeline\DeleteMutation',

                'createManager' => 'App\GraphQL\Mutation\User\Business\Manager\CreateMutation',
                'updateManager' => 'App\GraphQL\Mutation\User\Business\Manager\UpdateMutation',
                'updateManagerLocation' => 'App\GraphQL\Mutation\User\Business\Manager\UpdateLocationMutation',
                'deleteManager' => 'App\GraphQL\Mutation\User\Business\Manager\DeleteMutation',
                'setAdminManager' => 'App\GraphQL\Mutation\User\Business\Manager\SetAdminMutation',

                'createJob' => 'App\GraphQL\Mutation\User\Business\Job\CreateMutation',
                'updateJob' => 'App\GraphQL\Mutation\User\Business\Job\UpdateMutation',
                'updateJobLocation' => 'App\GraphQL\Mutation\User\Business\Job\UpdateLocationMutation',
                'updateJobStatuses' => 'App\GraphQL\Mutation\User\Business\Job\UpdateStatusesMutation',
                'updateJobStatus' => 'App\GraphQL\Mutation\User\Business\Job\UpdateStatusMutation',
                'deleteJob' => 'App\GraphQL\Mutation\User\Business\Job\DeleteMutation',

                /*
                 * Website business widget
                 */
                'createWidget' => 'App\GraphQL\Mutation\User\Business\Widget\CreateMutation',
                'updateWidget' => 'App\GraphQL\Mutation\User\Business\Widget\UpdateMutation',
                'deleteWidget' => 'App\GraphQL\Mutation\User\Business\Widget\DeleteMutation',

                'createButton' => 'App\GraphQL\Mutation\User\Business\Button\CreateMutation',
                'createButtonStatistic' => 'App\GraphQL\Mutation\User\Business\Button\CreateStatisticMutation',
                'updateButton' => 'App\GraphQL\Mutation\User\Business\Button\UpdateMutation',
                'deleteButton' => 'App\GraphQL\Mutation\User\Business\Button\DeleteMutation',

                'createChatMessage' => 'App\GraphQL\Mutation\User\Chat\CreateChatMessageMutation',
                'createChat' => 'App\GraphQL\Mutation\User\Chat\CreateChatMutation',
                'updateChatInterlocutor' => 'App\GraphQL\Mutation\User\Chat\UpdateChatInterlocutorMutation',
                'createInterviewRequest' => 'App\GraphQL\Mutation\User\CreateInterviewRequestMutation',
                'updateInterviewRequest' => 'App\GraphQL\Mutation\User\UpdateInterviewRequestMutation',

                'createCandidateWave' => 'App\GraphQL\Mutation\User\CreateCandidateWaveMutation',
                'deleteCandidateWave' => 'App\GraphQL\Mutation\User\DeleteCandidateWaveMutation',

                'createCustomer' => 'App\GraphQL\Mutation\User\Business\Billing\CreateCustomerMutation',
                'createCard' => 'App\GraphQL\Mutation\User\Business\Billing\CreateCardMutation',
                'updateCard' => 'App\GraphQL\Mutation\User\Business\Billing\UpdateCardMutation',
                'deleteCard' => 'App\GraphQL\Mutation\User\Business\Billing\DeleteCardMutation',
                'updateBillingAddress' => 'App\GraphQL\Mutation\User\Business\Billing\UpdateBillingAddressMutation',
                'createPayment' => 'App\GraphQL\Mutation\User\Business\Billing\CreatePaymentMutation',
                'cancelPayment' => 'App\GraphQL\Mutation\User\Business\Billing\CancelPaymentMutation',

                'createUserAcademy' => 'App\GraphQL\Mutation\User\CreateUserAcademyMutation',
                'inviteChildAcademy' => 'App\GraphQL\Mutation\User\InviteChildAcademyMutation',

                'sendVerificationCode' => 'App\GraphQL\Mutation\User\SendVerificationCodeMutation',

                'sendFeedback' => 'App\GraphQL\Mutation\User\SendFeedbackMutation',

                'uploadImportAts' => 'App\GraphQL\Mutation\User\Business\Import\CreateMutation',
                'ImportEmail' => 'App\GraphQL\Mutation\User\Business\Import\CreateImportMutation',

                'createIndeedAccount' => 'App\GraphQL\Mutation\User\Business\CreateIndeedAccountMutation',
                'deleteIndeedAccount' => 'App\GraphQL\Mutation\User\Business\DeleteIndeedAccountMutation',

                'saveLetsGetStarted' => 'App\GraphQL\Mutation\User\Business\SaveLetsGetStartedMutation',
                'doneStepIntegrationGuide' => 'App\GraphQL\Mutation\User\Business\DoneStepIntegrationGuideMutation',
                'saveHowToStartGotIt' => 'App\GraphQL\Mutation\User\Business\SaveHowToStartGotItMutation',
                'saveIntegrationToggle' => 'App\GraphQL\Mutation\User\Business\SaveIntegrationToggleMutation',


                'buildCodeBitLyJob' => 'App\GraphQL\Mutation\User\Business\BuildCodeBitLyJobMutation',


                'sendContactUs' => 'App\GraphQL\Mutation\SendContactUsMutation',
                'sendRequestCallback' => 'App\GraphQL\Mutation\SendRequestCallbackMutation',

                'savePreferenceFieldsUser' => 'App\GraphQL\Mutation\User\SavePreferenceFieldsUserMutation',

                'saveNewStartHereBusiness' => 'App\GraphQL\Mutation\User\Business\SaveNewStartHereBusinessMutation',

                'sendMyUserProfile' => 'App\GraphQL\Mutation\User\SendMyUserProfileMutation',
                'shareLink' => 'App\GraphQL\Mutation\User\ShareLinkMutation',


                'saveAnswerQuestionJob' => 'App\GraphQL\Mutation\User\Business\Job\SaveAnswerQuestionJobMutation',

            ],
            'middleware' => []
        ]
    ],

    /*
     * The types available in the application. You can access them from the
     * facade like this: GraphQL::type('user')
     *
     * Example:
     *
     * 'types' => [
     *     'user' => 'App\GraphQL\Type\UserType'
     * ]
     *
     * or without specifying a key (it will use the ->name property of your type)
     *
     * 'types' =>
     *     'App\GraphQL\Type\UserType'
     * ]
     */
    'types' => [
        'Api' => 'App\GraphQL\Type\ApiType',
        'Login' => 'App\GraphQL\Type\User\LoginType',
        'LoginSocial' => 'App\GraphQL\Type\User\LoginSocialType',
        'User' => 'App\GraphQL\Type\User\UserType',
        'UserCheck' => 'App\GraphQL\Type\User\UserCheckType',
        'SocialUser' => 'App\GraphQL\Type\User\SocialUserType',

        'UserImport' => 'App\GraphQL\Type\User\UserImportType',
        'ResumeWidget' => 'App\GraphQL\Type\ResumeWidgetType',
        'WidgetInfoCheck' => 'App\GraphQL\Type\User\Widget\InfoCheckType',

        'UpdateFieldRunFirst' => 'App\GraphQL\Type\User\UpdateFieldRunFirstType',

        'ResetPassword' => 'App\GraphQL\Type\User\ResetPasswordType',
        'ChangePassword' => 'App\GraphQL\Type\User\ChangePasswordType',
        'SendVerificationCode' => 'App\GraphQL\Type\User\SendVerificationCodeType',

        'ChangeEmail' => 'App\GraphQL\Type\User\Settings\ChangeEmailType',
        'ChangePass' => 'App\GraphQL\Type\User\Settings\ChangePassType',
        'SetShowTooltip' => 'App\GraphQL\Type\User\Settings\SetShowTooltipType',

        'SendFeedback' => 'App\GraphQL\Type\User\SendFeedbackType',

        'SavePrintBuilderSelection' => 'App\GraphQL\Type\User\Resume\SavePrintBuilderSelectionType',
        'DelPrintBuilderSelection' => 'App\GraphQL\Type\User\Resume\DelPrintBuilderSelectionType',
        'LoadPrintBuilderSelection' => 'App\GraphQL\Type\User\Resume\LoadPrintBuilderSelectionType',

        'Resume' => 'App\GraphQL\Type\User\Resume\ResumeType',
        'Send' => 'App\GraphQL\Type\User\Resume\SendType',
        'SentResume' => 'App\GraphQL\Type\User\Resume\SentResumeType',
        'SentResumes' => 'App\GraphQL\Type\User\Resume\SentResumesType',
        'UserPreference' => 'App\GraphQL\Type\User\Resume\PreferenceType',
        'UserAvailability' => 'App\GraphQL\Type\User\Resume\AvailabilityType',
        'UserBasicInfo' => 'App\GraphQL\Type\User\Resume\BasicInfoType',
        'UserEducation' => 'App\GraphQL\Type\User\Resume\EducationType',
        'UserExperience' => 'App\GraphQL\Type\User\Resume\ExperienceType',
        'UserReference' => 'App\GraphQL\Type\User\Resume\ReferenceType',
        'UserSkill' => 'App\GraphQL\Type\User\Resume\SkillType',
        'UserLanguage' => 'App\GraphQL\Type\User\Resume\LanguageType',
        'UserCertification' => 'App\GraphQL\Type\User\Resume\CertificationType',
        'UserDistinction' => 'App\GraphQL\Type\User\Resume\DistinctionType',
        'UserHobby' => 'App\GraphQL\Type\User\Resume\HobbyType',
        'UserInterest' => 'App\GraphQL\Type\User\Resume\InterestType',
        'UserSelection' => 'App\GraphQL\Type\User\Resume\SelectionType',

        'ExperienceFirstJob' => 'App\GraphQL\Type\User\Resume\ExperienceFirstJobType',
        'EducationNotDisplay' => 'App\GraphQL\Type\User\Resume\EducationNotDisplayType',
        'CertificationNot' => 'App\GraphQL\Type\User\Resume\CertificationNotType',
        'AutocompleteResume' => 'App\GraphQL\Type\User\Resume\AutocompleteType',

        'Reference' => 'App\GraphQL\Type\User\ReferenceType',
        'References' => 'App\GraphQL\Type\User\ReferencesType',
        'SendReference' => 'App\GraphQL\Type\User\SendReferenceType',

        'InviteInfo' => 'App\GraphQL\Type\InviteInfoType',
        'Geo' => 'App\GraphQL\Type\GeoType',
        'GeoStreet' => 'App\GraphQL\Type\GeoStreetType',
        'BusinessSize' => 'App\GraphQL\Type\BusinessSizeType',
        'Amenity' => 'App\GraphQL\Type\AmenityType',
        'Language' => 'App\GraphQL\Type\LanguageType',
        'JobType' => 'App\GraphQL\Type\JobType',
        'JobsType' => 'App\GraphQL\Type\JobsType',
        'JobCategory' => 'App\GraphQL\Type\JobCategoryType',
        'CareerLevel' => 'App\GraphQL\Type\CareerLevelType',
        'CareerLevels' => 'App\GraphQL\Type\CareerLevelsType',
        'Keyword' => 'App\GraphQL\Type\KeywordType',
        'Keywords' => 'App\GraphQL\Type\KeywordsType',
        'KeywordsPerPage' => 'App\GraphQL\Type\KeywordsPerPageType',
        'Certificate' => 'App\GraphQL\Type\CertificateType',
        'Certificates' => 'App\GraphQL\Type\CertificatesType',
        'WorldLanguage' => 'App\GraphQL\Type\WorldLanguageType',
        'WorldLanguages' => 'App\GraphQL\Type\WorldLanguagesType',
        'Category' => 'App\GraphQL\Type\CategoryType',
        'Industry' => 'App\GraphQL\Type\IndustryType',
        'IndustryCategories' => 'App\GraphQL\Type\IndustryCategoriesType',

        'Note' => 'App\GraphQL\Type\User\Business\Applicant\NoteType',
        'DeleteNote' => 'App\GraphQL\Type\User\Business\Applicant\DeleteNoteType',

        'HistoryMoved' => 'App\GraphQL\Type\User\Business\Applicant\HistoryMovedType',
        'RequestResume' => 'App\GraphQL\Type\User\Business\Applicant\RequestResumeType',
        'History' => 'App\GraphQL\Type\User\Business\Applicant\HistoryType',
        'Pipeline' => 'App\GraphQL\Type\User\Business\Applicant\PipelineType',
        'PipelineItem' => 'App\GraphQL\Type\User\Business\Applicant\PipelineItemType',
        'CandidateOverview' => 'App\GraphQL\Type\User\Business\Applicant\CandidateOverviewType',
        'Viewed' => 'App\GraphQL\Type\User\Business\Applicant\ViewedType',
        'Candidate' => 'App\GraphQL\Type\User\Business\Applicant\CandidateType',
        'Candidates' => 'App\GraphQL\Type\User\Business\Applicant\CandidatesType',
        'CandidateWave' => 'App\GraphQL\Type\User\CandidateWaveType',
        'Business' => 'App\GraphQL\Type\User\Business\BusinessType',
        'BusinessUnconfirmed' => 'App\GraphQL\Type\BusinessUnconfirmedType',
        'BusinessUnconfirmedPhone' => 'App\GraphQL\Type\BusinessUnconfirmedPhoneType',
        'UpdateImageBusiness' => 'App\GraphQL\Type\User\Business\UpdateImageBusinessType',
        'UpdateImageLocation' => 'App\GraphQL\Type\User\Business\UpdateImageLocationType',
        'DeleteImageBusiness' => 'App\GraphQL\Type\User\Business\DeleteImageBusinessType',
        'BusinessAdministrator' => 'App\GraphQL\Type\User\Business\AdministratorType',
        'ByLocation' => 'App\GraphQL\Type\User\Business\ByLocationType',
        'BusinessBrands' => 'App\GraphQL\Type\User\Business\BrandsType',
        'BusinessLocation' => 'App\GraphQL\Type\User\Business\LocationType',
        'BusinessLocations' => 'App\GraphQL\Type\User\Business\LocationsType',
        'BusinessDepartment' => 'App\GraphQL\Type\User\Business\DepartmentType',
        'BusinessDepartments' => 'App\GraphQL\Type\User\Business\DepartmentsType',
        'BusinessJob' => 'App\GraphQL\Type\User\Business\JobType',
        'BusinessJobs' => 'App\GraphQL\Type\User\Business\JobsType',
        'JobUnion' => 'App\GraphQL\Type\User\Business\JobUnionType',
        'Businesses' => 'App\GraphQL\Type\User\Business\BusinessesType',
        'MapBusiness' => 'App\GraphQL\Type\User\Business\MapBusinessType',
        'WebsiteButton' => 'App\GraphQL\Type\User\Business\WebsiteButtonType',
        'WebsiteWidget' => 'App\GraphQL\Type\User\Business\WebsiteWidgetType',
        'WebsiteWidgetBgImage' => 'App\GraphQL\Type\User\Business\WebsiteWidgetBgImageType',

        'WebsiteButtonStatistic' => 'App\GraphQL\Type\User\Business\WebsiteButtonStatisticType',
        'Card' => 'App\GraphQL\Type\User\Business\CardType',
        'Cards' => 'App\GraphQL\Type\User\Business\CardsType',
        'MonthlyPlan' => 'App\GraphQL\Type\MonthlyPlanType',
        'MonthlyPlans' => 'App\GraphQL\Type\MonthlyPlansType',
        'StripeCustomer' => 'App\GraphQL\Type\User\Business\StripeCustomerType',
        'StripeCard' => 'App\GraphQL\Type\User\Business\StripeCardType',
        'Discount' => 'App\GraphQL\Type\User\Business\DiscountType',
        'Tax' => 'App\GraphQL\Type\User\Business\TaxType',
        'Invoice' => 'App\GraphQL\Type\User\Business\InvoiceType',
        'Invoices' => 'App\GraphQL\Type\User\Business\InvoicesType',
        'BillingAddress' => 'App\GraphQL\Type\User\Business\BillingAddressType',
        'IndeedAccount' => 'App\GraphQL\Type\User\Business\IndeedAccountType',
        'Bmic' => 'App\GraphQL\Type\BmicType',

        'AdministratorPermit' => 'App\GraphQL\Type\User\Business\AdministratorPermitType',

        'JobQuestion' => 'App\GraphQL\Type\User\Business\JobQuestionType',
        'JobQuestions' => 'App\GraphQL\Type\User\Business\JobQuestionsType',
        'JobQuestionAnswer' => 'App\GraphQL\Type\User\Business\JobQuestionAnswerType',

        'BusinessImage' => 'App\GraphQL\Type\User\Business\ImageType',

        'KeywordsLocation' => 'App\GraphQL\Type\User\Business\KeywordsLocationType',
        'LocationsKeywords' => 'App\GraphQL\Type\User\Business\LocationsKeywordsType',
        'LocationManagers' => 'App\GraphQL\Type\User\Business\LocationManagersType',
        'BusinessManagers' => 'App\GraphQL\Type\User\Business\ManagersType',
        'BusinessManager' => 'App\GraphQL\Type\User\Business\ManagerType',
        'Chat' => 'App\GraphQL\Type\User\Chat\ChatType',
        'Chats' => 'App\GraphQL\Type\User\Chat\ChatsType',
        'ChatMember' => 'App\GraphQL\Type\User\Chat\ChatMemberType',
        'ChatInterlocutor' => 'App\GraphQL\Type\User\Chat\ChatInterlocutorType',
        'ChatMessage' => 'App\GraphQL\Type\User\Chat\ChatMessageType',
        'ChatMessages' => 'App\GraphQL\Type\User\Chat\ChatMessagesType',
        'CountOfUnreadChatMessages' => 'App\GraphQL\Type\User\Chat\CountOfUnreadChatMessagesType',
        'EmitChatTyping' => 'App\GraphQL\Type\User\Chat\EmitChatTypingType',
        'InterviewRequest' => 'App\GraphQL\Type\InterviewRequestType',
        'InterviewRequests' => 'App\GraphQL\Type\InterviewRequestsType',
        'CountsOfInterviewRequests' => 'App\GraphQL\Type\User\CountsOfInterviewRequestsType',

        'UserAcademy' => 'App\GraphQL\Type\User\UserAcademyType',
        'Academy' => 'App\GraphQL\Type\User\AcademyType',
        'School' => 'App\GraphQL\Type\User\SchoolType',

        'NotifyCounterBusiness' => 'App\GraphQL\Type\User\Business\NotifyCounterType',
        'NotifyCounterLastDateUser' => 'App\GraphQL\Type\User\NotifyCounterLastDateType',

        'Ats' => 'App\GraphQL\Type\User\Business\AtsType',
        'AtsList' => 'App\GraphQL\Type\User\Business\AtsListType',
        'InviteATSInfo' => 'App\GraphQL\Type\InviteATSInfoType',

        'LetsGetStarted' => 'App\GraphQL\Type\User\Business\LetsGetStartedType',
        'DoneStepIntegrationGuide' => 'App\GraphQL\Type\User\Business\DoneStepIntegrationGuideType',
        'HowToStartGotIt' => 'App\GraphQL\Type\User\Business\HowToStartGotItType',
        'IntegrationToggle' => 'App\GraphQL\Type\User\Business\IntegrationToggleType',

        'GetJobsAutoComplete' => 'App\GraphQL\Type\User\Business\GetJobsAutoCompleteType',
        'GetLocationsAutoComplete' => 'App\GraphQL\Type\User\Business\GetLocationsAutoCompleteType',
        'CodeBitLyJob' => 'App\GraphQL\Type\User\Business\CodeBitLyJobType',

        'GetDaysFromSendResume' => 'App\GraphQL\Type\User\Business\GetDaysFromSendResumeType',

        'SendContactUs' => 'App\GraphQL\Type\SendContactUsType',
        'SendRequestCallback' => 'App\GraphQL\Type\SendRequestCallbackType',

        'PricingStrategy' => 'App\GraphQL\Type\PricingStrategyType',

        'SavePreferenceFieldsUser' => 'App\GraphQL\Type\User\SavePreferenceFieldsUserType',

        'SaveNewStartHereBusiness' => 'App\GraphQL\Type\User\Business\SaveNewStartHereBusinessType',

        'SendMyUserProfile' => 'App\GraphQL\Type\User\SendMyUserProfileType',

        'GetDataSearch' => 'App\GraphQL\Type\GetDataSearchType',
        'ShareLink' => 'App\GraphQL\Type\ShareLinkType',
    ],

    /*
     * This callable will receive all the Exception objects that are caught by GraphQL.
     * The method should return an array representing the error.
     *
     * Typically:
     *
     * [
     *     'message' => '',
     *     'locations' => []
     * ]
     */
    'error_formatter' => [App\Exceptions\GraphQLExceptions::class, 'formatError'],

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ]
];
