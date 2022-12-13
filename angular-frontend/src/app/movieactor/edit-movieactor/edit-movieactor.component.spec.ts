import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditMovieactorComponent } from './edit-movieactor.component';

describe('EditMovieactorComponent', () => {
  let component: EditMovieactorComponent;
  let fixture: ComponentFixture<EditMovieactorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditMovieactorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EditMovieactorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
