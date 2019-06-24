import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { DataTablesModule } from 'angular-datatables';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgSelectizeModule } from 'ng-selectize';
import { TablesRoutes } from './tables.routing';

//Tables Component
import { DataTableComponent } from './data-table.component';


@NgModule({
    imports: [
        RouterModule.forChild(TablesRoutes),
        DataTablesModule,
        HttpClientModule,
        CommonModule,
        FormsModule,
        NgSelectizeModule,
    ],
    declarations: [
        DataTableComponent
    ]
})
export class TablesModule { }