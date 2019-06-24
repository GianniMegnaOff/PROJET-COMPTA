import { NgModule } from '@angular/core';
import { Routes } from '@angular/router';

//Extras Common Components

import { InvoiceComponent } from './invoice.component';
export const InvoiceRoutes: Routes = [
    {
        path: '',
        children: [
            
            {
                path: ':id_projet',
                component: InvoiceComponent,
                data: {
                    title: 'Invoice'
                }
            },
            
        ]        
    }
];

