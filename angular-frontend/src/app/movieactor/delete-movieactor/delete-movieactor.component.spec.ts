import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DeleteMovieactorComponent } from './delete-movieactor.component';

describe('DeleteMovieactorComponent', () => {
  let component: DeleteMovieactorComponent;
  let fixture: ComponentFixture<DeleteMovieactorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DeleteMovieactorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DeleteMovieactorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
