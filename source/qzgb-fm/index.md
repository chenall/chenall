title: 泉州广播网在线直播
date: 2010-04-18 00:53:23
id: 198
---
{% raw %}
<div>当前频道:</p> <select id="gbpd" name="qzgb" onchange="qzgb(this.value);"><option selected="selected" value="1">刺桐之声 FM 1059</option><option value="2">音乐之声 FM 881</option><option value="3">新闻频道 FM 889</option><option value="4">交通之声 FM 904</option><option value="5">体育频道 FM 914</option><option value="6">都市之声 FM 923</option><option value="7">音像直播(志明和春娇)</option><option value="8">泉广网络电视直播</option> </select><p>&nbsp;<a href="http://www.qzgb.com/881/" id="pdzy" target="_blank">频道主页</a>&nbsp;<a href="http://www.qzgb.com/881/index_time.shtml" id="play_list" target="_blank">节目时间表</a></p></div><div><a href="javascript:;" id="qz_1059" onclick="qzgb('1')">FM1059</a> <a href="javascript:;" id="qz_881" onclick="qzgb('2')">FM881</a> <a href="javascript:;" id="qz_889" onclick="qzgb('3')">FM889</a> <a href="javascript:;" id="qz_904" onclick="qzgb('4')">FM904</a> <a href="javascript:;" id="qz_914" onclick="qzgb('5')">FM914</a> <a href="javascript:;" id="qz_923" onclick="qzgb('6')">FM923</a> <a href="javascript:;" id="qz_914" onclick="qzgb('7')">音像直播</a> <a href="javascript:;" id="qz_914" onclick="qzgb('8')">视频直播</a></div><div id="VJMS">&nbsp;</div><p>
<script type="text/javascript">
function detectPlugin(CLSID,functionName)
{
    var pluginDiv = document.createElement("div");
    pluginDiv.id = "pluginDiv";
    VJMS.appendChild(pluginDiv);
    pluginDiv.innerHTML = '<object id="objectForDetectPlugin" classid="CLSID:'+ CLSID +'"></object>';
    try
    {
        if(eval("objectForDetectPlugin." + functionName) == undefined)
        {
            pluginDiv.parentNode.removeChild(pluginDiv);
            return false;
        }
        else
        {
				pluginDiv.parentNode.removeChild(pluginDiv);
            return true;
        }
    }
    catch(e)
    {
        return false;
    }
}
function qzgb(id)
{
        Live.action="type=live&amp;cid="+id;
        switch (id)
        {
                case "3":
                        fm="889";
                        play_list.href="http://www.qzgb.com/"+fm+"/index_time.shtml";
                        break;
                case "6":
                        fm="923";
                        play_list.href="http://www.qzgb.com/"+fm+"/index_time.shtml";
                        break;
                case "4":
                        fm="904";
                        play_list.href="http://www.qzgb.com/"+fm+"/index_time.shtml";
                        break;
                case "1":
                        fm="1059";
                        play_list.href="http://www.qzgb.com/"+fm+"/index_time.shtml";
                        break;
                case "2":
                        fm="881";
                        play_list.href="http://www.qzgb.com/881/5628.shtml";
                        break;
                case "5":
                        fm="914";
                        play_list.href="http://www.qzgb.com/914/5638.shtml";
                        break;
        }
        pdzy.href="http://www.qzgb.com/"+fm;
        gbpd.value = id;
        try{
            Live.Close();
            Live.Open();
        }
        catch (e){
        }
}

function vjms_add()
{
	var defobj = '<object id="Live" classid="CLSID:D4003189-95B1-4A2F-9A87-F2B03665960D" codeBase="http://www.nagasoft.cn/download/VJMS/vjocx-ch-black.cab">';
	if (!detectPlugin("D4003189-95B1-4A2F-9A87-F2B03665960D","PlayState") && detectPlugin("174012D5-4141-44D6-8F44-729BB97C56EB","PlayState"))
	{
		defobj = '<object id="Live" classid="CLSID:174012D5-4141-44D6-8F44-729BB97C56EB" codebase="http://www.nagasoft.cn/download/vjocx3/vjocx-ch.cab#version=3,0,101,0">';
	}
	defobj += '<param name="Nat" value="tv.qzgb.com:3502" /><param name="Stun" value="larry.gloo.net" /><param name="Cgi" value="http://tv.qzgb.com:20010/cgi-bin/live.fcgi" /><param name="PlayMode" value="full" /><param name="Volume" value=100 /><param name="FullScreen" value="false" /></object>';
	VJMS.innerHTML = defobj;
	qzgb(gbpd.value);
}
vjms_add();
</script>
{% endraw %}