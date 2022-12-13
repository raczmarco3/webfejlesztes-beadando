import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListMovieRegistryComponent } from './list-movie-registry.component';

describe('ListMovieRegistryComponent', () => {
  let component: ListMovieRegistryComponent;
  let fixture: ComponentFixture<ListMovieRegistryComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListMovieRegistryComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListMovieRegistryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
