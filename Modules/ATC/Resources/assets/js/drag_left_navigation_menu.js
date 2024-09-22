class DrableMenu {
  constructor(options = {}) {
    this.id_name = options.root ? options.root : "left_menu";
    this.id = "#" + this.id_name;

    this.root = $(this.id);

    this.group_name = options.group_class
      ? options.group_class
      : "group-category";
    this.onUpdate = options.onUpdate
      ? options.onUpdate
      : function () {
          console.log("null calback");
        };
    this.color_active = options.color_active ? options.color_active : "#81D4FA";
    this.filter_name = options.filter_class ? options.filter_class : "filter";
    this.item_name = options.item_class ? options.item_class : "item";
    this.width = $("." + this.item_name).width();
    this.height = $("." + this.item_name).height();
    
    this.height_position = $("." + this.item_name).outerHeight();
    
    this.move_box = false;
  }
  init() {
    var _this = this;
    this.root
      .on("mousedown", "." + this.filter_name, function () {
        _this.setTarget(this, true);
        _this.setStartVector();
      })
      .on("mousedown", "." + this.item_name, function () {
        _this.setTarget(this);
        _this.setStartVector();
      })
      .on("mousedown", function (e) {
        _this.dragOn(e);
      })
      .on("mouseup", function () {
        _this.dragOff();
      });
  }
}
DrableMenu.prototype.destroy = function () {
  this.root.off("mousemove");
  this.root.off("mouseup");
  this.root.off("mousedown");
  this.root.off("mousedown", "." + this.filter_name);
  this.root.off("mousedown", "." + this.item_name);
};
DrableMenu.prototype.setStartVector = function () {
  let { x, y } = this.getPositionMouse();
  this.start_vector = { x, y };
};
DrableMenu.prototype.setTarget = function (el, is_head = false) {
  this.group = $(el).closest("." + this.group_name);

  if (is_head == true) {
    this.move_box = true;
    this.item = null;
    this.target_row = null;
  }

  if (is_head == false) {
    this.item = $(el);
    this.move_box = false;
    this.index_end = this.item.index();
  }
};
DrableMenu.prototype.dragOff = function () {
  this.root.off("mousemove");
  this.root.css("cursor", "auto");

  this.removeColorShaDown();

  if (this.target_row != null) {
    this.root.find(".target-clone").remove();
  }
  this.onUpdate();
};

DrableMenu.prototype.moveItemDown = function (target_shadow_new) {
  
  let is_last = this.isLastItem();
  if (is_last == false) {
    // move down on group
    let item_end = this.target_shadow_row.next();
    item_end.after(target_shadow_new);
    return true;
  }

  // move down other group
  let is_last_group = this.isLastGroup();
  if (is_last_group == false) {
    // move down next group
    let group = this.target_shadow_row.closest("." + this.group_name).next();
    let item_end = group.find("." + this.filter_name).eq(0);
    item_end.after(target_shadow_new);
    return true;
  }

  // do nothing
  return false;
};
DrableMenu.prototype.isGroupNullItem = function (group) {
  return group.find("." + this.item_name).length == 0;
};
DrableMenu.prototype.isFirstGroup = function () {
  let group = this.target_shadow_row.closest("." + this.group_name);
  return group.index() == 0;
};
DrableMenu.prototype.moveItemUp = function (target_shadow_new) {
  if (this.isFirstItem() == false) {
    // move up on group
    let item_end = this.target_shadow_row.prev();
    // check previous item is filter
    if (item_end.attr("class") !== this.filter_name) {
      item_end.before(target_shadow_new);
      return true;
    }
  }

  // move up other group
  if (this.isFirstGroup() == false) {
    // move up previous group
    let group = this.target_shadow_row.closest("." + this.group_name).prev();
    // check group is null item
    if (this.isGroupNullItem(group)) {
      group.append(target_shadow_new);
    } else {
      let item_end = group.find("." + this.item_name).last();
      item_end.after(target_shadow_new);
    }

    return true;
  }

  // do nothing
  return false;
};
DrableMenu.prototype.isFirstItem = function () {
  return this.target_shadow_row.index() == 0;
};
DrableMenu.prototype.isLastItem = function () {
  let group = this.target_shadow_row.closest("." + this.group_name);
  let items_of_group = group.find("." + this.item_name).length;
  let item_index = this.target_shadow_row.index();
  return item_index == items_of_group;
};
DrableMenu.prototype.isLastGroup = function () {
  let len_group = this.root.find("." + this.filter_name).length;
  let group = this.target_shadow_row.closest("." + this.group_name);
  return group.index() + 1 == len_group;
};
DrableMenu.prototype.moveItem = function (distane_move) {
  let index_end = Math.floor(distane_move / this.height_position) + 1;

  // move on group
  if (this.index_end != index_end) {
    let target_shadow_new = this.target_shadow_row.clone();

    let action =
      index_end - this.index_end > 0
        ? this.moveItemDown(target_shadow_new)
        : this.moveItemUp(target_shadow_new);
    if (action) {
      this.target_shadow_row.remove();
      this.target_shadow_row = target_shadow_new;
      this.index_end = index_end;
    }
  }
};
DrableMenu.prototype.existUpGroup = function () {
  return this.group.index() != 0;
};
DrableMenu.prototype.moveGroup = function (distane_move) {
  var height = this.height_group
    ? this.height_group
    : this.target_shadow_row.outerHeight();
  if (distane_move >= height && distane_move > 0) {
    this.setStartVector();
    let target_shadow_row_new = this.target_shadow_row.clone();
    let group = this.target_shadow_row.next();

    if (group.html() && this.target_shadow_row != group) {
      this.height_group = group.outerHeight();
      group.after(target_shadow_row_new);
      this.target_shadow_row.remove();
      this.target_shadow_row = target_shadow_row_new;
    }
  }

  if (Math.abs(distane_move) >= height && distane_move < 0) {
    this.setStartVector();
    let target_shadow_row_new = this.target_shadow_row.clone();
    let group = this.target_shadow_row.prev();

    if (group.html() && this.target_shadow_row != group) {

      this.height_group = group.outerHeight();
      group.before(target_shadow_row_new);
      this.target_shadow_row.remove();
      this.target_shadow_row = target_shadow_row_new;
      
    }
  }
};
DrableMenu.prototype.detalHeightByScreen = function(y){
  // 148 - 240|72 - 370|45
  // 200|75 - 400|78 - 500|80
  console.log({y});

  if(y > 500){
    return 80;
  }
  if(y > 400){
    return 78;
  }
  if(y > 300){
    return 76;
  }
  if(y > 200){
    return 74;
  }
  return 72;
}
DrableMenu.prototype.showDefaultCloneRowMenu = function (target_row, e) {
  let x = e.clientX - 30;
  let y =  e.clientY - this.detalHeightByScreen(e.clientY);
  var _this = this;
  target_row.css("display","none");
  target_row.css("min-height","2rem");
  
  setTimeout(()=>{
    target_row.css({
      top: y,
      left: x,
      height: _this.height,
      width: _this.width,
      display:"block"
    });
  },200)
 
};
DrableMenu.prototype.setColorShaDown = function(){
   if(this.move_box == false){
      this.origin_color = this.target_shadow_row.css("background");
      this.target_shadow_row.css("background", this.color_active);
      return;
   }
   
   this.origin_color = this.target_shadow_row.find('.'+this.item_name).css("background");
   this.target_shadow_row.find('.'+this.item_name).css("background", this.color_active);

}
DrableMenu.prototype.removeColorShaDown = function(){
   if(this.move_box == false){
      this.target_shadow_row.css("background", this.origin_color);
      return;
   }
   
   this.target_shadow_row.find('.'+this.item_name).css("background",this.origin_color);
 
}
DrableMenu.prototype.dragOn = function (e) {
  let _this = this;
  this.root.css("cursor", "grabbing");
  var target_row = this.move_box ? this.group.clone() : this.item.clone();
  this.target_row = target_row;

  this.target_shadow_row = this.move_box ? this.group : this.item;

  this.setColorShaDown()

  target_row.addClass("target-clone");
  target_row.css("position", "absolute");
  this.root.append(target_row);

  this.showDefaultCloneRowMenu(target_row, e);

  this.root.on("mousemove", function (e) {
    let distane_move = e.clientY - _this.start_vector.y;

    if (_this.move_box == false) {
      _this.moveItem(distane_move);
    }

    if (_this.move_box == true) {
      _this.moveGroup(distane_move);
    }

    let x = e.clientX - 30;
    let y =  e.clientY -  _this.detalHeightByScreen(e.clientY);  

    target_row.css({
      top: y,
      left: x,
      height: _this.height,
      width: _this.width,
    });
  });
};

DrableMenu.prototype.getPositionMouse = function () {
  return {
    x: event.clientX,
    y: event.clientY,
  };
};

