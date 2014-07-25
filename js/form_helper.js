/**
 * Created by Saphir on 14-7-21.
 */
FormHelper={
    result:false,
    rules:[],
    Email:function(){
       var reg=new RegExp("/[^a-zA-Z0-9\/\+=]/");
        if(reg.match()){
            this.result=true;
        }
        return this.result;
    },
    AddRules:function(name,rule){
        this.rules[name]=rule;
    },
    Validate:function(){

    }
}