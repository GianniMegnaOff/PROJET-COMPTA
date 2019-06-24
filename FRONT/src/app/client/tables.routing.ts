import { NgModule } from '@angular/core';
import { Routes } from '@angular/router';

//Tables Components
import { DataTableComponent } from './data-table.component';

export const TablesRoutes: Routes = [
     {
        path: '',
        component: DataTableComponent,
        data: {
           title: 'Data Table'
        }
    }
];
