@if($command=='layout')
    <div id='{{$componentID}}' class='border-box'>

        <div class="small-box" style='background-color:[color]'>
            <div class='inner inner-box'>
                <h3>[sql]</h3>
                <p>[name]</p>
            </div>
            <div class="icon">
                <i class="ion [icon]"></i>
            </div>
            <a href="[link]" id='link{{$componentID}}' class="small-box-footer" style="display:block;">Más información<i class="fa fa-arrow-circle-right"></i></a>
            <script type="text/javascript"> 
            	if(document.getElementById('link{{$componentID}}').href != "[link]"){ 
            		document.getElementById('link{{$componentID}}').style="display:none;"; 
            	}
            </script>
        </div>

        <div class='action pull-right'>
            <a href='javascript:void(0)' data-componentid='{{$componentID}}' data-name='Small Box' class='btn-edit-component'><i class='fa fa-pencil'></i></a>
            &nbsp;
            <a href='javascript:void(0)' data-componentid='{{$componentID}}' class='btn-delete-component'><i class='fa fa-trash'></i></a>
        </div>
    </div>
@elseif($command=='configuration')
    <form method='post'>
        <input type='hidden' name='_token' value='{{csrf_token()}}'/>
        <input type='hidden' name='componentid' value='{{$componentID}}'/>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" required name='config[name]' type='text' value='{{@$config->name}}'/>
        </div>

        <div class="form-group">
            <label>Icon By Ionicons</label>
            <input class="form-control" name='config[icon]' type='text' value='{{@$config->icon}}'/>
            E.g : ion-bag . You can find more icon, checkout at <a target='_blank' href='http://ionicons.com/'>ionicons.com</a>
        </div>

        <div class="form-group">
            <label>Color</label>
            <input class="form-control" type="color" required name='config[color]' value='{{@$config->color}}' />
        </div>

        <div class="form-group">
            <label>Link</label>
            <input class="form-control" name='config[link]' type='text' value='{{@$config->link}}'/>
        </div>

        <div class="form-group">
            <label>Count (SQL QUERY)</label>
            <textarea name='config[sql]' rows="5" class='form-control'>{{@$config->sql}}</textarea>
            <div class="help-block">Make sure the sql query are correct unless the widget will be broken. Mak sure give the alias name each column. You may use
                alias [SESSION_NAME] to get the session
            </div>
        </div>

    </form>
@elseif($command=='showFunction')
    <?php
    if ($key == 'sql') {
        try {
            $sessions = Session::all();
            foreach ($sessions as $key => $val) {
                $value = str_replace("[".$key."]", $val, $value);
            }
            echo reset(DB::select(DB::raw($value))[0]);
        } catch (\Exception $e) {
            echo 'ERROR';
        }
    } else {
        echo $value;
    }

    ?>
@endif	
