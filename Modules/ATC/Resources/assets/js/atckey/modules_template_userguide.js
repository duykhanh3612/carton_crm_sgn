class Userguide{
    constructor(el){
        this.root = $(el);
        this.introJs = introJs();
        this.introJs.setOptions({
            // skipLabel:'Skip',
            showBullets:false,
            showProgress: true,
            
        }).onexit(()=>{
            $.cookie("skip-userguide",true);
            console.log("set cookie");
            console.log($.cookie("skip-userguide"));
        })
        .onchange(function(){
            console.log(this)
        })

        this.steps = [];

        // // set null for test
        // $.cookie("skip-userguide",null);
    }
}
Userguide.prototype.addEventListener = function(){
    var _this = this;
    this.loadStep();

    this.root.on("click",".userguide",function(){
        _this.root.find(".nav-item a").eq(0).trigger("click");
        _this.introJs.goToStepNumber(1).start();
    })

    var isSkip =  $.cookie("skip-userguide");
    console.log({isSkip})
    if(!isSkip){
        _this.introJs.goToStepNumber(0).start();
    }

}
Userguide.prototype.stepNewLayer = function(el){
    var el = $("[data-layer=1]").last().get(0);
    this.steps.push({
        element: el,
        title: 'Layer 1',
        intro: 'It shows all layer2',
        position: 'top'
    })

}
Userguide.prototype.loadStep = async function(){
    this.firstAttention();
    this.addNewLayer1();
    this.stepNewLayer();
    this.groupControlLayer1();
    this.editNameLayer1();
    this.propertyLayer1();
    // this.addEditLayer2();
    this.introJs.addSteps(this.steps);
}
Userguide.prototype.groupControlLayer1 = function(){
    this.steps.push(
        {
            element:".group-control-layer1",
            title: 'Group control',
            intro: 'You can add or remove property. Click edit to show/hide edit icon layer2',
            position: 'left'
        }
    )
}
Userguide.prototype.addEditLayer2 = function(){
    this.steps.push(
        {
            element:".modal-content",
            title: 'Modal add/edit one layer2',
            intro: 'You can add/remove/edit properties of layer2.',
            position: 'bottom'
        }
    )
}
Userguide.prototype.editNameLayer1 = function(){

    this.steps.push(
        {
            element:".title-layer1",
            title: 'Title layer1',
            intro: 'Click icon edit to can change name layer1',
            position: 'right'
        }
    )
}
Userguide.prototype.propertyLayer1 = function(){

    this.steps.push(
        {
            element:".form-group",
            title: 'Form group',
            intro: 'This is property in layer1, you can edit when click icon.',
            position: 'right',
        }
    )
}
Userguide.prototype.firstAttention = function(){
    this.steps.push(
        {
            element: '.userguide',
            title: 'User guide',
            intro: 'Click icon to show user guide',
            position: 'left',
        }
    )
        
    
}

Userguide.prototype.addNewLayer1 = function(){

    this.steps.push(
        {
            element: '.group-btn-layer1',
            title: 'New Layer 1',
            intro: 'Input name and click button add to create new layer 1',
        }
    )

}

$(document).ready(function(){
    var ug = new Userguide("#nav-tabContent-modules");
    ug.addEventListener();

})