<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" ng-click="cancel()">&times;</button>
        <h4 class="modal-title">Edit Term</h4>
    </div>
    <div class="modal-body">
        <div class="input-field">
            <label for="data.description">Description</label>
            <input ng-model="data.description" type="text" class="validate" id="form-name" placeholder="Description..." />
        </div>
        <div class="input-field">
            <label for="data.days">Days</label>
            <input ng-model="data.days" type="text" class="validate" id="form-name" placeholder="Days..." />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="save()">Save</button>
    </div>
</div>
