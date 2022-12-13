import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListMovieactorComponent } from './list-movieactor.component';

describe('ListMovieactorComponent', () => {
  let component: ListMovieactorComponent;
  let fixture: ComponentFixture<ListMovieactorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListMovieactorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListMovieactorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
