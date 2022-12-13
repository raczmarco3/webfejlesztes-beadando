import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddMovieactorComponent } from './add-movieactor.component';

describe('AddMovieactorComponent', () => {
  let component: AddMovieactorComponent;
  let fixture: ComponentFixture<AddMovieactorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AddMovieactorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AddMovieactorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
