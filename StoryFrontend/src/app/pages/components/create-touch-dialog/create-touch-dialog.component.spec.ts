import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateTouchDialogComponent } from './create-touch-dialog.component';

describe('CreateTouchDialogComponent', () => {
  let component: CreateTouchDialogComponent;
  let fixture: ComponentFixture<CreateTouchDialogComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CreateTouchDialogComponent]
    });
    fixture = TestBed.createComponent(CreateTouchDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
