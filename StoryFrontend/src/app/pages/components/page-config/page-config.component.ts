import { Location } from '@angular/common';
import { Component, ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CanvasService } from 'src/app/core/services/componentServices/canvas.service';
import { CanvasComponent } from '../canvas/canvas.component';
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';
import { CreateTouchDialogComponent } from '../create-touch-dialog/create-touch-dialog.component';
import { StoryService } from 'src/app/core/services/componentServices/story.service';

@Component({
  selector: 'app-page-config',
  templateUrl: './page-config.component.html',
  styleUrls: ['./page-config.component.css']
})
export class PageConfigComponent {
  links: string[] = [];
  activeLink: any | undefined;
  pages: any | undefined;

  constructor(
    private storyService: StoryService,
    private location: Location,
    private route: ActivatedRoute,
    public dialog: MatDialog
  ) { }

  @ViewChild('myCanvas') canvasComponent!: CanvasComponent;

  ngOnInit() {

    //get the story id from current route
    const routeParams = this.route.snapshot.paramMap;
    const storyIdFromRoute = Number(routeParams.get('id'));

    this.storyService.getPageOfStory(storyIdFromRoute).subscribe((response) => {
      this.pages = response.data;

      //sort follow the page_number
      this.pages.sort((a: any, b: any) => a.page_number - b.page_number);

      //add to link navtab
      for (let page of this.pages) {
        this.links.push(`Page ${page.page_number}`);
      }
      this.activeLink = this.links[0];
    });

    
  }

  goBack(): void {
    this.location.back();
  }

  addLink() {
    this.links.push(`Page ${this.links.length + 1}`);
  }

}
