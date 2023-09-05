import { Component } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { StoryService } from '../services/story.service';

export class StoryComponent {

  constructor(
    private storyService: StoryService,
    private formBuilder: FormBuilder,
  ) {}

  checkoutForm = this.formBuilder.group({

  });

  onSubmit(): void {

  }

}