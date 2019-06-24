import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { ThemeConstants } from '../shared/config/theme-constant';
import { ChartsModule } from 'ng2-charts';
import 'd3';
import 'nvd3';
import { NvD3Module } from 'ng2-nvd3';
import { PerfectScrollbarModule } from 'ngx-perfect-scrollbar';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { DashboardRoutes } from './dashboard-routing.module';

//Dashboard Component
import { DashboardComponent } from './dashboard.component';

@NgModule({
    imports: [
        RouterModule.forChild(DashboardRoutes),
        ChartsModule,
        NvD3Module,
        PerfectScrollbarModule,
        HttpClientModule,
        CommonModule,
        FormsModule,
    ],
    declarations: [
        DashboardComponent
    ],
    providers: [
        ThemeConstants 
    ]
})
export class DashboardModule { }