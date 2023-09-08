import { Location } from '@angular/common';
import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CanvasService } from 'src/app/core/services/canvas.service';
import { PageService } from 'src/app/core/services/page.service';

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
    private pageService: PageService,
    private location: Location,
    private route: ActivatedRoute,
    private canvasService: CanvasService,
  ) { }

  ngOnInit() {

    //get the story id from current route
    const routeParams = this.route.snapshot.paramMap;
    const storyIdFromRoute = Number(routeParams.get('id'));

    this.pageService.getPages().subscribe((response) => {
      this.pages = response;

      //find the page that correspond with the story
      this.pages = this.pages.filter((page: any) => page.story_id === storyIdFromRoute);
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

  addRect(){
    this.canvasService.addRect();
  }
}
