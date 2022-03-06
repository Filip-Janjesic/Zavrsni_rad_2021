<?php include_once "head.php"?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small> Feel free to contact us </small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> 
                                    Name of your OPG 
                                </label>
                                <input type="text" class="form-control" id="name" placeholder="OPG" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Your email address
                                </label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" class="form-control" id="email" placeholder="email" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Farm Meeting
                                </label>
                                <select id="subject" name="subject" class="form-control" required="required">
                                    <option value="na" selected="">Choose</option>
                                    <option value="service">Farm Type</option>
                                    <option value="suggestions">Meeting</option>
                                    <option value="product">OPG</option>
                                    <option value="product">Reason</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Message
                                </label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                          placeholder="Message">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs" style="background: #358CCE">
                                Send message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend>
                    <span class="glyphicon glyphicon-globe"></span> 
                    Our location
                </legend>
                <address>
                    <strong>Farm Meeting</strong><br>
                    St. King address, 999 <br>
                    Osijek, 31000<br>
                    <abbr title="Phone">
                        Phone:
                    </abbr>
                     (099) 999-9999
                </address>
                <address>
                    <a href="mailto:#">contact@farmmeeting.com</a>
                </address>
            </form>
        </div>
    </div>
</div>