import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { InvoiceRoutes } from './invoice.routing';
import { NgSelectizeModule } from 'ng-selectize';
import { StickyModule } from 'ng2-sticky-kit';
import { ScrollToModule } from 'ng2-scroll-to';
import { NgxMasonryModule } from 'ngx-masonry';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


// Extras Component
import { InvoiceComponent } from './invoice.component';


@NgModule({
    imports: [
        CommonModule,
        RouterModule.forChild(InvoiceRoutes),
        StickyModule,
        NgxMasonryModule,
        ScrollToModule.forRoot(),
        HttpClientModule,
        CommonModule,
        NgSelectizeModule,
        FormsModule, 
        ReactiveFormsModule
    ],
    declarations: [
        InvoiceComponent
    ]
})
export class InvoiceModule { }
