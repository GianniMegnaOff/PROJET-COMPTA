import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { DataTablesModule } from 'angular-datatables';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgSelectizeModule } from 'ng-selectize';
import { ProjetRoutes } from './projet.routing';

import { ToastyModule } from 'ng2-toasty';
import { NotificationCommunicationService } from './../ui-elements/notification/notification.services';

//Tables Component
import { ProjetComponent } from './projet.component';
import { ProjetDetailComponent } from './projet-detail.component';

@NgModule({
    imports: [
        RouterModule.forChild(ProjetRoutes),
        DataTablesModule,
        HttpClientModule,
        CommonModule,
        FormsModule,
        NgSelectizeModule,
        FormsModule, 
        ReactiveFormsModule,
        ToastyModule,
    ],
    declarations: [
        ProjetComponent,
        ProjetDetailComponent
    ],
     providers: [
      NotificationCommunicationService
    ]
})
export class ProjetModule { }