;(function($,window,undefined) {
    $.fn.yuukCountDown = function(options) {
        var defaults = {
            starttime: '',              //start time
            endtime: '',                //end time
            startCallBack: $.noop,      //time start callback
            notStartCallBack: $.noop,   //time not start callback
            endCallBack: $.noop         //time end callback
        },
        opts = $.extend(defaults, options);
        return this.each(function(i,v){
            var timeCountDown = {
                timer: null,
                countDown: function(){
                    var _this = this;
                    var nowTime = Math.round(new Date().getTime()/1000),
        				startTime = Math.round(new Date(opts.starttime) / 1000);
                        endTime = Math.round(new Date(opts.endtime) / 1000);

                    var endLeftTime = endTime - nowTime,
        				startLeftTime = startTime - nowTime,
        				day = parseInt(endLeftTime / 60 / 60 / 24),
                        hour = parseInt(endLeftTime / 60 / 60 % 24),
                        minute = parseInt(endLeftTime / 60 % 60),
                        second = parseInt(endLeftTime % 60),
        				ms = parseInt((new Date(opts.endtime) - new Date().getTime()) % 1000);

                    return{
        				endLeftTime: endLeftTime,
        				startLeftTime: startLeftTime,
                        day: day,
                        hour: hour,
                        minute: minute,
                        second: second,
        				ms: ms
                    }
                },
                setHtml: function(time){
                    var _this = this,
        				_endLeftTime = time.endLeftTime,
        				_startLeftTime = time.startLeftTime,
                        _day = _this.fillZero(time.day),
                        _hour = _this.fillZero(time.hour),
                        _minite = _this.fillZero(time.minute),
                        _second = _this.fillZero(time.second),
        				_ms = _this.fillZero(time.ms.toString().substr(0,2));


                    //倒计时未开始
                    if(_startLeftTime > 0){
                        if(opts.notStartCallBack){
                            opts.notStartCallBack(time);
                        }
                    }
                    else{
                        //正在倒数计
            			if(_endLeftTime > 0){
                            $(v).html([
            					'<li class="item styleDay"><i class="day">'+_day+'<span>days</span></i></li>',
            					//'<li class="blank">:</li>',
            					'<li class="item styleDay"><i class="hour">'+_hour+'<span>hours</span></i></li>',
            					//'<li class="blank">:</li>',
            					'<li class="item styleDay"><i class="minute">'+_minite+'<span>minutes</span></i></li>',
            					//'<li class="blank">:</li>',
            					'<li class="item styleDay"><i class="second">'+_second+'<span>seconds</span></i></li>'
            					//'<li class="blank">:</li>',
            					//'<li class="item"><i class="ms">'+_ms+'</i><span>milliseconds</span></li>'
            				].join(' '));
                            if(opts.startCallBack){
                                opts.startCallBack(time);
                            }
                        }
                        //倒计时结束
                        if(_endLeftTime <= 0){
                            if(opts.endCallBack){
                                opts.endCallBack(time);
                            }
                            clearInterval(_this.timer);
                        }
                    }
                },
                fillZero: function(num){
                    if (num < 10) {
                        num = "0" + num;
                    }
                    return num;
                },
                init: function(){
                    var _this = this;
                    if(new Date(opts.endtime) <= new Date(opts.starttime)){
                        throw new Error('倒计时的开始时间不能大于结束时间~');
                        return false;
                    }
                    this.timer = setInterval(function(){
                        _this.setHtml(_this.countDown());
                    },10);
                }
            }
            timeCountDown.init();
        });
    };
})(jQuery,window,undefined);
