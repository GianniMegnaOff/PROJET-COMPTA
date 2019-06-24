import { Component } from '@angular/core';
import { TemplateService } from '../../shared/services/template.service';

@Component({
    selector: 'app-header',
    templateUrl: './header.component.html'
})
export class HeaderComponent  {

    searchModel : string;
    isCollapse: boolean;
    isOpen: boolean;
    searchActived: boolean = false;

    constructor(private tplSvc: TemplateService) {
    }

    ngOnInit(): void {
        this.tplSvc.isSideNavCollapseChanges.subscribe(isCollapse => this.isCollapse = isCollapse);
        this.tplSvc.isSidePanelOpenChanges.subscribe(isOpen => this.isOpen = isOpen);
    }    

    toggleSideNavCollapse() {
        this.isCollapse = !this.isCollapse;
        this.tplSvc.toggleSideNavCollapse(this.isCollapse);
    }

    toggleSidePanelOpen() {
        this.isOpen = !this.isOpen;
        this.tplSvc.toggleSidePanelOpen(this.isOpen);
    }

    toggleSearch () {
        this.searchActived = !this.searchActived;
        console.log(this.searchActived)
    }
}
