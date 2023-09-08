import { ComponentFixture, TestBed } from '@angular/core/testing';

import { StoryConfigComponent } from './story-config.component';

describe('StoryConfigComponent', () => {
  let component: StoryConfigComponent;
  let fixture: ComponentFixture<StoryConfigComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [StoryConfigComponent]
    });
    fixture = TestBed.createComponent(StoryConfigComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
