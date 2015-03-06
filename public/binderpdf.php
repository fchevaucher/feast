<form action="client.php?do=binder" method="post">
<center>start date:
<select style="width:41px;margin-right:2px" name="binderstartday">
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
<select style="width:55px;margin-right:2px" name="binderstartmonth">
<option value="01">Jan</option>
<option value="02" >Feb</option>
<option value="03" >Mar</option>
<option value="04" >Apr</option>
<option value="05" >May</option>
<option value="06" >Jun</option>
<option value="07" >Jul</option>
<option value="08" >Aug</option>
<option value="09" >Sep</option>
<option value="10" >Oct</option>
<option value="11" >Nov</option>
<option value="12" >Dec</option>
</select>
<input type="text" name="binderstartyear" style="width:40px;" value="<?php echo date('Y');?>"><br />
end date:
<select style="width:41px;margin-right:2px" name="binderendday">
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
<select style="width:55px;margin-right:2px" name="binderendmonth">
<option value="01">Jan</option>
<option value="02" >Feb</option>
<option value="03" >Mar</option>
<option value="04" >Apr</option>
<option value="05" >May</option>
<option value="06" >Jun</option>
<option value="07" >Jul</option>
<option value="08" >Aug</option>
<option value="09" >Sep</option>
<option value="10" >Oct</option>
<option value="11" >Nov</option>
<option value="12" >Dec</option>
</select>
<input type="text" name="binderendyear" style="width:40px;" value="<?php echo date('Y');?>"><br /><br /><br /><input type="submit" value="make pdf" /></center></form>
