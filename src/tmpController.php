<?php

class {{className}} extends Controller {

    /**
     * Rule constructor class it's call __construct of parent class
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * 
     */
    public function index() {
        
        // return $this->view->render("somthing.view");

    }
    
    /**
     * Display the specified resource.
     *
     * @param  Int  $id
     * @return Response
     * 
     */
    public function show($id) {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     * 
     */
    public function store($request) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Array $field
     * @param  Int  $id
     * @return Response
     * 
     */
    public function edit($field, $id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Int  $id
     * @return Response
     * 
     */
    public function update($request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $id
     * @return Response
     * 
     */
    public function destroy($id) {
        
    }


}