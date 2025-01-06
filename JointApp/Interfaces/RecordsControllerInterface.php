<?php


namespace JointApp\Interfaces;


interface RecordsControllerInterface extends ControllerInterface
{
    /*
     *
     */
    public function controllerFilterParams($controllerParams = []): void;






    /*
     * prepare view fields to display list records view
     */
    public function getListView():void;

    /*
     * prepare view fields to display parts od list records view for ajax, json response
     * post filter form or page - its buttons
     */
    public function applyFilterView():void;

    /*
    * prepare view fields to display detail view
     */
    public function getDetailView():void;

    /*
     * prepare view fields to display edit view
     */
    public function getEditView():void;

    /*
     * action update record and
     * prepare view fields and result message to display edit view
     */
    public function postEditView():void;

    /*
     * prepare view fields to display delete view
     */
    public function getDeleteView():void;

    /*
    * action delete record and
    * prepare view fields and result message to display delete view
    */
    public function postDeleteView():void;

    /*
    * prepare view fields to display new view
    */
    public function getNewView():void;

    /*
    * action create record and
    * prepare view fields and result message to display new view
    */
    public function postNewView():void;
}