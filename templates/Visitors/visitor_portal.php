<h1>Welcome, Visitor</h1>

<div id="spa" class="ui segment loading basic"><br /><br /><br /></div>

<script>
let blockId = null;
let unitId = null;
let name = null;
let contact = null;
let nric = null;
let unitAllowCheckIn = false;

let page1 = function() {
    jQuery("#spa").removeClass("loading");
    jQuery("#spa").html('<div class="ui placeholder segment">\
        <div class="ui two column very relaxed stackable grid">\
            <div class="column">\
            <div class="ui big button check-in">\
                <i class="door open icon"></i>\
                Check In\
            </div>\
            </div>\
            <div class="middle aligned column">\
            <div class="ui big button check-out">\
            <i class="sign out alternate icon"></i></i>\
                Check Out\
            </div>\
            </div>\
        </div>\
        <div class="ui vertical divider">\
            Or\
        </div>\
    </div>');
}

let page2 = function() {
    jQuery.get("<?= $this->Url->build("/api/flat-blocks.json") ?>", function(data, textStatus, jqXHR){
        jQuery("#spa").removeClass("loading");
        let question = document.createElement("h2");
        jQuery(question).html("Which block are you visiting?");

        let blockSelection = document.createElement("div");
        jQuery(blockSelection).addClass("ui eight link cards centered");

        data.forEach(function(currentValue, index, arr){
            let blockCard = document.createElement("div");
            jQuery(blockCard).addClass("ui card block-select");
            jQuery.data(blockCard, "flat_block_id", currentValue["id"]);

            let blockCardContent = document.createElement("div");
            jQuery(blockCardContent).addClass("content");
            jQuery(blockCard).append(blockCardContent);

            let blockCardContentMeta = document.createElement("div");
            jQuery(blockCardContentMeta).addClass("meta");
            jQuery(blockCardContentMeta).html("Block");
            jQuery(blockCardContent).append(blockCardContentMeta);

            let blockCardContentDescription = document.createElement("div");
            jQuery(blockCardContentDescription).addClass("description");
            jQuery(blockCardContentDescription).html(currentValue["block"]);
            jQuery(blockCardContent).append(blockCardContentDescription);

            jQuery(blockSelection).append(blockCard);
        });

        jQuery("#spa").html(question);
        jQuery("#spa").append(blockSelection);
    });
}

let page3 = function() {
    jQuery.get("<?= $this->Url->build("/") ?>api/flat-blocks/" + blockId + ".json", function(data, textStatus, jqXHR) {
        jQuery("#spa").removeClass("loading");

        let question = document.createElement("h2");
        jQuery(question).html("Which unit in block " + data["block"] + " are you visiting?");

        let unitSelection = document.createElement("div");
        jQuery(unitSelection).addClass("ui eight link cards centered");

        data["flat_units"].forEach(function(currentValue, index, arr){
            
            let unitCard = document.createElement("div");
            jQuery(unitCard).addClass("card unit-select");
            jQuery.data(unitCard, "flat_unit_id", currentValue["id"]);
            if (!currentValue["check_in_allowed"]) {
                jQuery(unitCard).addClass("ui disabled");
                jQuery(unitCard).append("<div class='ui red top attached label'>Max Visitors Reached</div>");
            }

            let unitCardContent = document.createElement("div");
            jQuery(unitCardContent).addClass("content");
            jQuery(unitCard).append(unitCardContent);

            let unitCardContentMeta = document.createElement("div");
            jQuery(unitCardContentMeta).addClass("meta");
            jQuery(unitCardContentMeta).html("Unit");
            jQuery(unitCardContent).append(unitCardContentMeta);

            let unitCardContentDescription = document.createElement("div");
            jQuery(unitCardContentDescription).addClass("description");
            jQuery(unitCardContentDescription).html(currentValue["unit"]);
            jQuery(unitCardContent).append(unitCardContentDescription);

            let unitCardExtra = document.createElement("div");
            jQuery(unitCardExtra).addClass("extra content");
            if (currentValue["check_in_allowed"]) {
                jQuery(unitCardExtra).html("Current No. of Visitors: " + currentValue["visitors_count"]);
            } else {
                jQuery(unitCardExtra).html("Current No. of Visitors: <span class='ui red text'>" + currentValue["visitors_count"] + "</span>");
            }
            jQuery(unitCard).append(unitCardExtra);

            jQuery(unitSelection).append(unitCard);
        });

        jQuery("#spa").html(question);
        jQuery("#spa").append(unitSelection);
    });
}

let page4 = function() {
    jQuery("#spa").removeClass("loading");
    
    let registrationForm = document.createElement("form");
    jQuery(registrationForm).addClass("ui large form centered grid");

    let registrationFormSegment = document.createElement("div");
    jQuery(registrationFormSegment).addClass("ui stacked segment four wide column");
    jQuery(registrationForm).append(registrationFormSegment);


    let registrationFormSegmentFieldName = document.createElement("div");
    jQuery(registrationFormSegmentFieldName).addClass("field");
    jQuery(registrationFormSegment).append(registrationFormSegmentFieldName);

    let registrationFormSegmentFieldInputName = document.createElement("div");
    jQuery(registrationFormSegmentFieldInputName).addClass("ui left icon input");
    jQuery(registrationFormSegmentFieldName).append(registrationFormSegmentFieldInputName);

    let registrationFormSegmentFieldInputNameIcon = document.createElement("i");
    jQuery(registrationFormSegmentFieldInputNameIcon).addClass("user icon");
    jQuery(registrationFormSegmentFieldInputName).append(registrationFormSegmentFieldInputNameIcon);

    let registrationFormSegmentFieldInputNameInput = document.createElement("input");
    jQuery(registrationFormSegmentFieldInputNameInput).attr("type", "text");
    jQuery(registrationFormSegmentFieldInputNameInput).attr("name", "name");
    jQuery(registrationFormSegmentFieldInputNameInput).attr("placeholder", "What's your name in your NRIC?");
    jQuery(registrationFormSegmentFieldInputName).append(registrationFormSegmentFieldInputNameInput);


    let registrationFormSegmentFieldContact = document.createElement("div");
    jQuery(registrationFormSegmentFieldContact).addClass("field");
    jQuery(registrationFormSegment).append(registrationFormSegmentFieldContact);

    let registrationFormSegmentFieldInputContact = document.createElement("div");
    jQuery(registrationFormSegmentFieldInputContact).addClass("ui left icon input");
    jQuery(registrationFormSegmentFieldContact).append(registrationFormSegmentFieldInputContact);

    let registrationFormSegmentFieldInputContactIcon = document.createElement("i");
    jQuery(registrationFormSegmentFieldInputContactIcon).addClass("phone icon");
    jQuery(registrationFormSegmentFieldInputContact).append(registrationFormSegmentFieldInputContactIcon);

    let registrationFormSegmentFieldInputContactInput = document.createElement("input");
    jQuery(registrationFormSegmentFieldInputContactInput).attr("type", "text");
    jQuery(registrationFormSegmentFieldInputContactInput).attr("name", "contact");
    jQuery(registrationFormSegmentFieldInputContactInput).attr("placeholder", "What's your contact number?");
    jQuery(registrationFormSegmentFieldInputContact).append(registrationFormSegmentFieldInputContactInput);


    let registrationFormSegmentFieldNric = document.createElement("div");
    jQuery(registrationFormSegmentFieldNric).addClass("field");
    jQuery(registrationFormSegment).append(registrationFormSegmentFieldNric);

    let registrationFormSegmentFieldInputNric = document.createElement("div");
    jQuery(registrationFormSegmentFieldInputNric).addClass("ui left icon input");
    jQuery(registrationFormSegmentFieldNric).append(registrationFormSegmentFieldInputNric);

    let registrationFormSegmentFieldInputNricIcon = document.createElement("i");
    jQuery(registrationFormSegmentFieldInputNricIcon).addClass("id card icon");
    jQuery(registrationFormSegmentFieldInputNric).append(registrationFormSegmentFieldInputNricIcon);

    let registrationFormSegmentFieldInputNricInput = document.createElement("input");
    jQuery(registrationFormSegmentFieldInputNricInput).attr("type", "text");
    jQuery(registrationFormSegmentFieldInputNricInput).attr("name", "nric");
    jQuery(registrationFormSegmentFieldInputNricInput).attr("placeholder", "What's the last 3 digits of your NRIC?");
    jQuery(registrationFormSegmentFieldInputNric).append(registrationFormSegmentFieldInputNricInput);


    let submitBtn = document.createElement("div");
    jQuery(submitBtn).addClass("ui fluid huge teal submit button register");
    jQuery(submitBtn).html("Check In");
    jQuery(registrationFormSegment).append(submitBtn);

    
    jQuery("#spa").html(registrationForm);
}

let page5 = function() {
    jQuery("#spa").removeClass("loading");

    let registeredContainer = document.createElement("div");
    jQuery(registeredContainer).addClass("ui three cards centered");

    let registeredCard = document.createElement("div");
    jQuery(registeredCard).addClass("ui card");
    jQuery(registeredContainer).append(registeredCard);


    let registeredCardContent = document.createElement("div");
    jQuery(registeredCardContent).addClass("content");
    jQuery(registeredCard).append(registeredCardContent);

    let registeredCardContentHeader = document.createElement("div");
    jQuery(registeredCardContentHeader).addClass("header");
    jQuery(registeredCardContentHeader).html("Registered");
    jQuery(registeredCardContent).append(registeredCardContentHeader);

    let registeredCardContentDescriptionName = document.createElement("div");
    jQuery(registeredCardContentDescriptionName).addClass("description");
    jQuery(registeredCardContentDescriptionName).html(name);
    jQuery(registeredCardContent).append(registeredCardContentDescriptionName);

    let registeredCardContentDescriptionContact = document.createElement("div");
    jQuery(registeredCardContentDescriptionContact).addClass("description");
    jQuery(registeredCardContentDescriptionContact).html(contact);
    jQuery(registeredCardContent).append(registeredCardContentDescriptionContact);

    let registeredCardContentDescriptionNric = document.createElement("div");
    jQuery(registeredCardContentDescriptionNric).addClass("description");
    jQuery(registeredCardContentDescriptionNric).html(nric);
    jQuery(registeredCardContent).append(registeredCardContentDescriptionNric);

    if (unitAllowCheckIn) {
        let registeredCardActions = document.createElement("div");
        jQuery(registeredCardActions).addClass("ui two bottom attached buttons");
        jQuery(registeredCard).append(registeredCardActions);

        let registeredCardActionsCheckIn = document.createElement("div");
        jQuery(registeredCardActionsCheckIn).addClass("ui button check-in-again");
        jQuery(registeredCardActionsCheckIn).html("Check In Another");
        jQuery(registeredCardActions).append(registeredCardActionsCheckIn);

        let registeredCardActionsBack = document.createElement("div");
        jQuery(registeredCardActionsBack).addClass("ui button back");
        jQuery(registeredCardActionsBack).html("Back to Menu");
        jQuery(registeredCardActions).append(registeredCardActionsBack);
    } else {
        jQuery(registeredCard).append('<div class="ui two bottom attached buttons">\
            <div class="ui button disabled red">Max Visitors Reached</div>\
            <div class="ui button back">Back to Menu</div>\
        </div>');
    }
    

    
    jQuery("#spa").html(registeredContainer);

}

let pageCheckOutForm = function() {
    jQuery("#spa").removeClass("loading");
    jQuery("#spa").html('<form class="ui large form centered grid">\
        <div class="ui stacked segment four wide column">\
            <div class="field">\
                <div class="ui left icon input">\
                    <i class="id card icon"></i>\
                    <input type="text" name="nric" placeholder="What is the last 3 digits of your NRIC?" />\
                </div>\
            </div>\
            <div class="ui fluid huge orange submit button check-out">Check Out</div>\
        </div>\
    </form>');
}

let pageCheckOutComplete = function() {
    jQuery("#spa").removeClass("loading");
    jQuery("#spa").html('<div class="ui four cards centered">\
        <div class="ui card">\
            <div class="content">\
                <div class="header">\
                    Checked Out\
                </div>\
            </div>\
            <div class="ui two bottom attached buttons">\
                <div class="ui button check-out-again">Check Out Another</div>\
                <div class="ui button back-to-menu">Back to Menu</div>\
            </div>\
        </div>\
    </div>');
}

jQuery(document).ready(function($){
    // Initialise first page
    page1();

    /**
     * Event Triggers
     */
    // page1
    jQuery("#spa").on("click", ".button.check-in", function(){
        jQuery("#spa").addClass("loading");
        page2();
    });
    jQuery("#spa").on("click", ".button.check-out", function(){
        jQuery("#spa").addClass("loading");
        pageCheckOutForm();
    });

    // page2
    jQuery("#spa").on("click", ".block-select", function(){
        blockId = jQuery.data(this, "flat_block_id");
        jQuery("#spa").addClass("loading");
        page3();
    });

    // page3
    jQuery("#spa").on("click", ".unit-select", function(){
        unitId = jQuery.data(this, "flat_unit_id");
        jQuery("#spa").addClass("loading");
        page4();
    });

    // page4
    jQuery("#spa").on("click", ".submit.button.register", function(){
        jQuery("#spa").addClass("loading");
        jQuery.post("<?= $this->Url->build("/") ?>api/flat-units/" + unitId + "/visitors.json", {
            name: jQuery("input[name=name]").val(),
            contact: jQuery("input[name=contact]").val(),
            nric: jQuery("input[name=nric]").val(),
            flat_unit_id: unitId
        }, function(data, textStatus, jqXHR){
            name = jQuery("input[name=name]").val();
            contact = jQuery("input[name=contact]").val();
            nric = jQuery("input[name=nric]").val();
            unitAllowCheckIn = data["visitorEntity"]["flat_unit"]["check_in_allowed"];
            page5();
        });
    });

    // page5
    jQuery("#spa").on("click", ".button.check-in-again", function(){
        jQuery("#spa").addClass("loading");
        page4();
    });
    jQuery("#spa").on("click", ".button.back", function(){
        jQuery("#spa").addClass("loading");
        page1();
    });
    
    // pageCheckOutForm
    jQuery("#spa").on("change", "input[name=nric]", function() {
        nric = jQuery("input[name=nric]").val();
    });
    jQuery("#spa").on("click", ".submit.button.check-out", function(){
        jQuery("#spa").addClass("loading");
        jQuery.post("<?= $this->Url->build("/") ?>api/visitors/visitorCheckOut.json", {
            nric: nric
        }, function(data, textStatus, jqXHR){
            pageCheckOutComplete();
        });
    });

    // pageCheckOutComplete
    jQuery("#spa").on("click", ".button.check-out-again", function(){
        jQuery("#spa").addClass("loading");
        pageCheckOutForm();
    });
    jQuery("#spa").on("click", ".button.back-to-menu", function(){
        jQuery("#spa").addClass("loading");
        page1();
    });
});
</script>